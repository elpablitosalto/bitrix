<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Application;
use Bitrix\Rest\RestException;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Engine\ActionFilter;
use Bitrix\Main\Loader;
use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Context;
use Bitrix\Main\Mail\Event;

Loader::includeModule("iblock");

class VotesContestForm extends \CBitrixComponent implements Controllerable
{
    const TYPE_VOTE_AUTH = 'AUTH';
    const TYPE_VOTE_ALL = 'ALL';
    const NODE_CLASS_ACTIVE_BUTTON = 'active_button_for_vote';

    public ?array $arTempParams = [];

    public int $participantsId = 0;
    public int $iblockId = 0;
    public int $contestId = 0;
    public string $typeVote = '';
    public string $noAuthVoted = 'false';


    public function __construct($component = null)
    {
        parent::__construct($component);
    }


    public function executeComponent()
    {
        CJSCore::Init();
        CJSCore::Init(["jquery"]);

        $this->arTempParams = $this->arParams;
        $this->arResult['PARTICIPANTS_CURRENT_IDS'] = $this->getCurrentIdsUserVoted($this->arTempParams['IBLOCK_ID'], $this->arTempParams['PARTICIPANTS_ID']);

        if ($this->checkRequiredParams($this->arTempParams)) {
            $this->getTypeTemplateVote($this->arTempParams['TYPE_VOTE']);
        }
    }





    /**
     * @param string $typeVote
     */
    public function getTypeTemplateVote(string $typeVote)
    {

        global $USER;
        $this->arResult['ACTIVE_BUTTON_FOR_VOTE'] = '';

        if (!empty($this->arResult['PARTICIPANTS_CURRENT_IDS'])) {
            if ($USER->GetID()) {
                if (!empty($this->arParams['USER_ID'])) {
                    if (in_array($this->arParams['USER_ID'], $this->arResult['PARTICIPANTS_CURRENT_IDS'])) {
                        $this->arResult['ACTIVE_BUTTON_FOR_VOTE'] = self::NODE_CLASS_ACTIVE_BUTTON;
                    }
                }
            } else {
                if (!empty($_COOKIE['USER_VOTED_FOR_PARTICIPANT_ID_' . $this->arTempParams['PARTICIPANTS_ID']])) {
                    $this->arResult['ACTIVE_BUTTON_FOR_VOTE'] = self::NODE_CLASS_ACTIVE_BUTTON;
                }
            }
        }


        switch ($typeVote) {
            case self::TYPE_VOTE_AUTH:

                if (!$this->checkUserAuthorised()) {
                    $this->includeComponentTemplate('auth_button');
                } else {
                    $this->includeComponentTemplate('all_button');
                }

                break;
            case self::TYPE_VOTE_ALL:
                $this->includeComponentTemplate('all_button');
                break;
        }
    }


    /**
     * @param array $arParams
     * @return bool
     */
    public function checkRequiredParams(array $arParams): bool
    {
        if (!empty($arParams['CONTEST_ID'])) {
            if (!empty($arParams['IBLOCK_ID'])) {
                if (!empty($arParams['TYPE_VOTE'])) {
                    return true;
                }
            }
        }
        return false;
    }


    /**
     * @return bool
     */
    public function checkUserAuthorised(): bool
    {
        if (!empty($this->arTempParams['USER_ID'])) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @param array $arPost
     */
    public function setAllNeedParamsClass(array $arPost): void
    {
        foreach ($arPost['data']['dataForm'] as $keyPost => $valuePost) {
            switch ($valuePost['name']) {
                case 'user_id':
                    $this->userId = $valuePost['value'];
                    break;
                case 'contest_id':
                    $this->contestId = $valuePost['value'];
                    break;
                case 'participants_id':
                    $this->participantsId = $valuePost['value'];
                    break;
                case 'iblock_id':
                    $this->iblockId = $valuePost['value'];
                    break;
                case 'type_vote':
                    $this->typeVote = $valuePost['value'];
                    break;
            }
        }
    }


    /**
     * @return array|null
     */
    public function executionSendFormAddVoteAction(): ?array
    {
        $arPost = $this->request->getPostList()->toArray();
        $this->setAllNeedParamsClass($arPost);

        $arCurrentVotedUser = $this->getCurrentIdsUserVoted($this->iblockId, $this->participantsId);
        $intCurrentOverallVoted = $this->getCurrentOverallVoted($this->iblockId, $this->participantsId);
        $intCurrentNoAuthVoted = $this->getCurrentNoAuthVoted($this->iblockId, $this->participantsId);

        $arValueUpdate = $arCurrentVotedUser;

        if ($this->checkUserIsAuth($this->userId)) {
            if ($this->checkExistVoteForUser($arCurrentVotedUser, $this->userId)) {
                $arValueUpdate[$this->userId] = 0;
                $intUpdateOverallVoted = $intCurrentOverallVoted - 1;
            } else {
                $arValueUpdate += [$this->userId => $this->userId];
                $intUpdateOverallVoted = $intCurrentOverallVoted + 1;
            }

            $this->updateVotedAuthType($arValueUpdate);
        } else {
            if ($this->checkExistVoteForNoAuthUser($this->participantsId)) {
                $intUpdateNoAuthVoted = $intCurrentNoAuthVoted - 1;
                $intUpdateOverallVoted = $intCurrentOverallVoted - 1;
            } else {
                $intUpdateNoAuthVoted = $intCurrentNoAuthVoted + 1;
                $intUpdateOverallVoted = $intCurrentOverallVoted + 1;
            }

            $this->noAuthVoted = 'true';
            $this->updateVotedNoAuthType($intUpdateNoAuthVoted);
        }

        $this->updatedOverallVoted($intUpdateOverallVoted);

        if ($intUpdateOverallVoted > $intCurrentOverallVoted) {
            $strActionVoteResponse = 'true';
        } else {
            $strActionVoteResponse = 'false';
        }

        $arResponse = [
            'action_vote' => $strActionVoteResponse,
            'no_auth' => $this->noAuthVoted,
            'participantsId' => $this->participantsId,
            'status' => false,
            'intUpdateOverallVoted' => $intUpdateOverallVoted
        ];

        return $arResponse;
    }


    /**
     * @param int $participantsId
     * @return bool
     */
    public function checkExistVoteForNoAuthUser(int $participantsId): bool
    {
        if ($_COOKIE['USER_VOTED_FOR_PARTICIPANT_ID_' . $participantsId] === 'true') {
            return true;
        }
        return false;
    }


    /**
     * @param $arValueUpdate
     */
    public function updateVotedAuthType($arValueUpdate): void
    {
        CIBlockElement::SetPropertyValuesEx($this->participantsId, $this->iblockId, ['VOTED' => $arValueUpdate]);
    }


    /**
     *
     */
    public function updateVotedNoAuthType($intUpdateNoAuthVoted): void
    {
        CIBlockElement::SetPropertyValuesEx($this->participantsId, $this->iblockId, ['VOTED_WITHOUT_AUTH' => $intUpdateNoAuthVoted]);
    }


    /**
     * @param int $iblockId
     * @param $participantId
     * @return int
     */
    public function getCurrentNoAuthVoted(int $iblockId, $participantId): int
    {
        $db_props = CIBlockElement::GetProperty($iblockId, $participantId, [], ['CODE' => 'VOTED_WITHOUT_AUTH']);
        if ($ar_props = $db_props->Fetch()) {
            $intCurrentVotedUserNoAuth = $ar_props['VALUE'];
        }

        if (empty($intCurrentVotedUserNoAuth)) {
            $intCurrentVotedUserNoAuth = 0;
        }

        return $intCurrentVotedUserNoAuth;
    }


    /**
     * @param int $iblockId
     * @param $participantId
     * @return int
     */
    public function getCurrentOverallVoted(int $iblockId, int $participantId): int
    {
        $db_props = CIBlockElement::GetProperty($iblockId, $participantId, [], ['CODE' => 'SUM_VOTED']);
        if ($ar_props = $db_props->Fetch()) {
            $intCurrentVotedUser = $ar_props['VALUE'];
        }

        if (empty($intCurrentVotedUser)) {
            $intCurrentVotedUser = 0;
        }

        return $intCurrentVotedUser;
    }


    /**
     * @param int $iblockId
     * @param $participantId
     * @return int
     */
    public function updatedOverallVoted(int $intUpdateOverallVoted): void
    {
        CIBlockElement::SetPropertyValuesEx($this->participantsId, $this->iblockId, ['SUM_VOTED' => $intUpdateOverallVoted]);
    }


    /**
     * @param int $iblockId
     * @param int $participantId
     * @return array
     */
    public function getCurrentIdsUserVoted(int $iblockId, int $participantId): array
    {
        $db_props = CIBlockElement::GetProperty($iblockId, $participantId, [], ['CODE' => 'VOTED']);
        while ($ar_props = $db_props->GetNext()) {
            $arCurrentVotedUser[$ar_props['VALUE']] = $ar_props['VALUE'];
        }
        return $arCurrentVotedUser;
    }


    /**
     * @param array $arCurrentValues
     * @param int $idUser
     * @return bool
     */
    public function checkExistVoteForUser(array $arCurrentValues, string $idUser): bool
    {
        if (in_array($idUser, $arCurrentValues)) {
            return true;
        }
        return false;
    }


    /**
     * @param string $idUser
     * @return bool
     */
    public function checkUserIsAuth(string $idUser): bool
    {
        $rsUser = CUser::GetByID($idUser);
        if (!empty($rsUser->Fetch())) {
            return true;
        }
        return false;
    }


    /**
     * @return array[][]
     */
    public function configureActions()
    {
        return [
            'executionSendFormAddVote' => [
                'prefilters' => [

                ],
            ]
        ];
    }


    /**
     * @param $arParams
     * @return mixed
     */
    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }
}