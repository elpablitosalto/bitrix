<?
define('FIRST_CONTENT_PAGE_TYPE', 2);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Галерея");
$APPLICATION->SetPageProperty("PAGE_BODY_CLASS", 'ReferenceMetaPage sect_or bigSlider');
$APPLICATION->SetPageProperty("PAGE_H1", 'Referenzen');
$APPLICATION->SetPageProperty("PAGE_H2", 'Die Bühnen des Lebens');
$APPLICATION->SetPageProperty("PAGE_DESCRIPTION", '<p>Bei vielen öffentlichen Plätzen und Boulevards in Europa hat man sich für Steine aus dem METTEN-Sortiment entschieden. Diese Orte sind Prüfstein und Beleg für eine Qualität, die Lebensfreude trägt und verbreitet - über viele Jahrzehnte.</p>');
?>

<?
// Слайдшоу -->
//$this->SetViewTarget('slideShow');
ob_start();
?>
<div class="slide" itemscope itemtype="https://schema.org/ImageObject">
  <meta itemprop="contentUrl" content="https://www.metten.de/assets/Produkt-Referenzen/La-Linia-Nikolai-Quartier-Hamburg-2335-472.jpg" />
  <meta itemprop="thumbnailUrl" content="https://www.metten.de/assets/Produkt-Referenzen/La-Linia-Nikolai-Quartier-Hamburg-2335-472__ScaleMaxWidthWzkwXQ.jpg" />
  <img class="bbimg" src="<?=SITE_TEMPLATE_PATH?>/images/La-Linia-Nikolai-Quartier-Hamburg-2335-472__FocusFillMaxWyIwLjAwIiwiMC4wMCIsMTIwMCw1MDBd.jpg" sizes="(min-width:1200px) 1200px, 100vw" data-little="1" style="object-position:50% 50%;" width="1200" height="500" alt="" title="" />
</div>
<?
//$this->EndViewTarget();
$out1 = ob_get_contents();
ob_end_clean();
$APPLICATION->AddViewContent('slideShow', $out1);
// <-- Слайдшоу
?>

<div class="bgGrau wideGallery">
  <div class=" responsiveBlock">
    <div id="RefKatList">
      <div class="refKatWrap">
        <div class="refKatTitle filterButton visible"> <span class="buttonDesc">Kategorien</span><span class="pfeil icon-pfeil"> </span></div>
        <div class="refKatListe">
          <a class="refKat" href="/referenzen/bahnhoefe/" title="Bahnhöfe"><span class="title">Bahnhöfe</span></a>
          <a class="refKat" href="/referenzen/barrierefreies-bauen/" title="Barrierefreies Bauen"><span class="title">Barrierefreies Bauen</span></a> <a class="refKat" href="/referenzen/einkaufszentren-und-banken/" title="Einkaufszentren und Banken"><span class="title">Einkaufszentren und Banken</span></a> <a class="refKat" href="/referenzen/hotels-und-gastronomie/" title="Hotels und Gastronomie"><span class="title">Hotels und Gastronomie</span></a> <a class="refKat" href="/referenzen/innengestaltung/" title="Innengestaltung"><span class="title">Innengestaltung</span></a> <a class="refKat" href="/referenzen/kinder-und-bildung/" title="Kinder und Bildung"><span class="title">Kinder und Bildung</span></a> <a class="refKat" href="/referenzen/kongress-und-veranstaltungszentren/" title="Kongress- und Veranstaltungszentren"><span class="title">Kongress- und Veranstaltungszentren</span></a> <a class="refKat" href="/referenzen/kunst-und-kultur/" title="Kunst und Kultur"><span class="title">Kunst und Kultur</span></a> <a class="refKat" href="/referenzen/plaetze-und-promenaden/" title="Plätze und Promenaden"><span class="title">Plätze und Promenaden</span></a> <a class="refKat" href="/referenzen/unternehmen/" title="Unternehmen"><span class="title">Unternehmen</span></a> <a class="refKat" href="/referenzen/stadien-und-schwimmbaeder/" title="Stadien und Schwimmbäder"><span class="title">Stadien und Schwimmbäder</span></a> <a class="refKat" href="/referenzen/kliniken-und-seniorenheime/" title="Kliniken und Seniorenheime"><span class="title">Kliniken und Seniorenheime</span></a> <a class="refKat" href="/referenzen/stadt-und-dorfgestaltung/" title="Stadt- und Dorfgestaltung"><span class="title">Stadt- und Dorfgestaltung</span></a> <a class="refKat" href="/referenzen/universitaet/" title="Universität"><span class="title">Universität</span></a> <a class="refKat" href="/referenzen/wohnquartiere-und-privatobjekte/" title="Wohnquartiere und Privatobjekte"><span class="title">Wohnquartiere und Privatobjekte</span></a> <a class="refKat" href="/unternehmen/internationalitaet/" title="Internationale Projekte"><span class="title">Internationale Projekte</span></a>
        </div>
      </div>
    </div>
  </div>
</div>




<div class="bgGrau wideGallery">
  <div class=" responsiveBlock">

    <div id="BigBlocks" class="bigBlocks">


      <a class="bigBlock bigBlockM " href="/unternehmen/lizenznehmer-partner/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/Metten-Consulting__FocusFillWyIwLjAwIiwiMC4wMCIsNTgwLDI3MF0.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="570" height="255" alt="Lizenznehmer und Partner" title="Metten Consulting" />


        <div class="content">
          <div class="title ">Lizenznehmer und Partner </div>
          <p class="text d">Unsere Lizenznehmer und internationalen Partner.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/aktivitaeten/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/aktivitaeten-metten.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Aktivitäten" title="aktivitaeten metten" />


        <div class="content">
          <div class="title ">Aktivitäten </div>
          <p class="text d">Veranstaltungen für Fachpublikum aus den Bereichen Architektur, Garten- und Landschaftsbau, Baustoffhandel und Stadtplanung.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/karriere-ausbildung/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/stellenangebote-teaser.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Stellenangebote" title="stellenangebote teaser" />


        <div class="content">
          <div class="title ">Stellenangebote </div>
          <p class="text d">Karriere bei Metten - Stellenangebote und Ausbildungsangebote.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/lizenznehmer-partner/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/Metten-Consulting__FocusFillWyIwLjAwIiwiMC4wMCIsNTgwLDI3MF0.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="570" height="255" alt="Lizenznehmer und Partner" title="Metten Consulting" />


        <div class="content">
          <div class="title ">Lizenznehmer und Partner </div>
          <p class="text d">Unsere Lizenznehmer und internationalen Partner.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/aktivitaeten/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/aktivitaeten-metten.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Aktivitäten" title="aktivitaeten metten" />


        <div class="content">
          <div class="title ">Aktivitäten </div>
          <p class="text d">Veranstaltungen für Fachpublikum aus den Bereichen Architektur, Garten- und Landschaftsbau, Baustoffhandel und Stadtplanung.</p>

        </div>
      </a>




      <a class="bigBlock bigBlockM " href="/unternehmen/karriere-ausbildung/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/stellenangebote-teaser.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Stellenangebote" title="stellenangebote teaser" />


        <div class="content">
          <div class="title ">Stellenangebote </div>
          <p class="text d">Karriere bei Metten - Stellenangebote und Ausbildungsangebote.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/service/kataloge/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/Gartentraeume-2023-24-Katalogtitel__FocusFillWyIwLjAwIiwiMC4wMCIsNTgwLDI3MF0.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="2560" height="1200" alt="Katalog Gartenträume" title="Gartentraeume 2023 24 Katalogtitel" />


        <div class="content">
          <div class="title ">Katalog Gartenträume </div>


        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/lizenznehmer-partner/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/Metten-Consulting__FocusFillWyIwLjAwIiwiMC4wMCIsNTgwLDI3MF0.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="570" height="255" alt="Lizenznehmer und Partner" title="Metten Consulting" />


        <div class="content">
          <div class="title ">Lizenznehmer und Partner </div>
          <p class="text d">Unsere Lizenznehmer und internationalen Partner.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/aktivitaeten/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/aktivitaeten-metten.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Aktivitäten" title="aktivitaeten metten" />


        <div class="content">
          <div class="title ">Aktivitäten </div>
          <p class="text d">Veranstaltungen für Fachpublikum aus den Bereichen Architektur, Garten- und Landschaftsbau, Baustoffhandel und Stadtplanung.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/karriere-ausbildung/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/stellenangebote-teaser.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Stellenangebote" title="stellenangebote teaser" />


        <div class="content">
          <div class="title ">Stellenangebote </div>
          <p class="text d">Karriere bei Metten - Stellenangebote und Ausbildungsangebote.</p>

        </div>
      </a>




      <a class="bigBlock bigBlockM " href="/unternehmen/lizenznehmer-partner/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/Metten-Consulting__FocusFillWyIwLjAwIiwiMC4wMCIsNTgwLDI3MF0.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="570" height="255" alt="Lizenznehmer und Partner" title="Metten Consulting" />


        <div class="content">
          <div class="title ">Lizenznehmer und Partner </div>
          <p class="text d">Unsere Lizenznehmer und internationalen Partner.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/aktivitaeten/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/aktivitaeten-metten.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Aktivitäten" title="aktivitaeten metten" />


        <div class="content">
          <div class="title ">Aktivitäten </div>
          <p class="text d">Veranstaltungen für Fachpublikum aus den Bereichen Architektur, Garten- und Landschaftsbau, Baustoffhandel und Stadtplanung.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/karriere-ausbildung/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/stellenangebote-teaser.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Stellenangebote" title="stellenangebote teaser" />


        <div class="content">
          <div class="title ">Stellenangebote </div>
          <p class="text d">Karriere bei Metten - Stellenangebote und Ausbildungsangebote.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/lizenznehmer-partner/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/Metten-Consulting__FocusFillWyIwLjAwIiwiMC4wMCIsNTgwLDI3MF0.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="570" height="255" alt="Lizenznehmer und Partner" title="Metten Consulting" />


        <div class="content">
          <div class="title ">Lizenznehmer und Partner </div>
          <p class="text d">Unsere Lizenznehmer und internationalen Partner.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/aktivitaeten/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/aktivitaeten-metten.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Aktivitäten" title="aktivitaeten metten" />


        <div class="content">
          <div class="title ">Aktivitäten </div>
          <p class="text d">Veranstaltungen für Fachpublikum aus den Bereichen Architektur, Garten- und Landschaftsbau, Baustoffhandel und Stadtplanung.</p>

        </div>
      </a>




      <a class="bigBlock bigBlockM " href="/unternehmen/karriere-ausbildung/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/stellenangebote-teaser.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Stellenangebote" title="stellenangebote teaser" />


        <div class="content">
          <div class="title ">Stellenangebote </div>
          <p class="text d">Karriere bei Metten - Stellenangebote und Ausbildungsangebote.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/service/kataloge/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/Gartentraeume-2023-24-Katalogtitel__FocusFillWyIwLjAwIiwiMC4wMCIsNTgwLDI3MF0.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="2560" height="1200" alt="Katalog Gartenträume" title="Gartentraeume 2023 24 Katalogtitel" />


        <div class="content">
          <div class="title ">Katalog Gartenträume </div>


        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/lizenznehmer-partner/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/Metten-Consulting__FocusFillWyIwLjAwIiwiMC4wMCIsNTgwLDI3MF0.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="570" height="255" alt="Lizenznehmer und Partner" title="Metten Consulting" />


        <div class="content">
          <div class="title ">Lizenznehmer und Partner </div>
          <p class="text d">Unsere Lizenznehmer und internationalen Partner.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/aktivitaeten/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/aktivitaeten-metten.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Aktivitäten" title="aktivitaeten metten" />


        <div class="content">
          <div class="title ">Aktivitäten </div>
          <p class="text d">Veranstaltungen für Fachpublikum aus den Bereichen Architektur, Garten- und Landschaftsbau, Baustoffhandel und Stadtplanung.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/karriere-ausbildung/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/stellenangebote-teaser.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Stellenangebote" title="stellenangebote teaser" />


        <div class="content">
          <div class="title ">Stellenangebote </div>
          <p class="text d">Karriere bei Metten - Stellenangebote und Ausbildungsangebote.</p>

        </div>
      </a>




      <a class="bigBlock bigBlockM " href="/unternehmen/lizenznehmer-partner/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/Metten-Consulting__FocusFillWyIwLjAwIiwiMC4wMCIsNTgwLDI3MF0.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="570" height="255" alt="Lizenznehmer und Partner" title="Metten Consulting" />


        <div class="content">
          <div class="title ">Lizenznehmer und Partner </div>
          <p class="text d">Unsere Lizenznehmer und internationalen Partner.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/aktivitaeten/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/aktivitaeten-metten.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Aktivitäten" title="aktivitaeten metten" />


        <div class="content">
          <div class="title ">Aktivitäten </div>
          <p class="text d">Veranstaltungen für Fachpublikum aus den Bereichen Architektur, Garten- und Landschaftsbau, Baustoffhandel und Stadtplanung.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/karriere-ausbildung/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/stellenangebote-teaser.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Stellenangebote" title="stellenangebote teaser" />


        <div class="content">
          <div class="title ">Stellenangebote </div>
          <p class="text d">Karriere bei Metten - Stellenangebote und Ausbildungsangebote.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/lizenznehmer-partner/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/Metten-Consulting__FocusFillWyIwLjAwIiwiMC4wMCIsNTgwLDI3MF0.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="570" height="255" alt="Lizenznehmer und Partner" title="Metten Consulting" />


        <div class="content">
          <div class="title ">Lizenznehmer und Partner </div>
          <p class="text d">Unsere Lizenznehmer und internationalen Partner.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/aktivitaeten/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/aktivitaeten-metten.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Aktivitäten" title="aktivitaeten metten" />


        <div class="content">
          <div class="title ">Aktivitäten </div>
          <p class="text d">Veranstaltungen für Fachpublikum aus den Bereichen Architektur, Garten- und Landschaftsbau, Baustoffhandel und Stadtplanung.</p>

        </div>
      </a>




      <a class="bigBlock bigBlockM " href="/unternehmen/karriere-ausbildung/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/stellenangebote-teaser.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Stellenangebote" title="stellenangebote teaser" />


        <div class="content">
          <div class="title ">Stellenangebote </div>
          <p class="text d">Karriere bei Metten - Stellenangebote und Ausbildungsangebote.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/service/kataloge/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/Gartentraeume-2023-24-Katalogtitel__FocusFillWyIwLjAwIiwiMC4wMCIsNTgwLDI3MF0.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="2560" height="1200" alt="Katalog Gartenträume" title="Gartentraeume 2023 24 Katalogtitel" />


        <div class="content">
          <div class="title ">Katalog Gartenträume </div>


        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/lizenznehmer-partner/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/Metten-Consulting__FocusFillWyIwLjAwIiwiMC4wMCIsNTgwLDI3MF0.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="570" height="255" alt="Lizenznehmer und Partner" title="Metten Consulting" />


        <div class="content">
          <div class="title ">Lizenznehmer und Partner </div>
          <p class="text d">Unsere Lizenznehmer und internationalen Partner.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/aktivitaeten/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/aktivitaeten-metten.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Aktivitäten" title="aktivitaeten metten" />


        <div class="content">
          <div class="title ">Aktivitäten </div>
          <p class="text d">Veranstaltungen für Fachpublikum aus den Bereichen Architektur, Garten- und Landschaftsbau, Baustoffhandel und Stadtplanung.</p>

        </div>
      </a>

      <a class="bigBlock bigBlockM " href="/unternehmen/karriere-ausbildung/">
        <img class="bbimg" loading="lazy" data-size="M" src="<?= SITE_TEMPLATE_PATH ?>/images/stellenangebote-teaser.jpg" sizes="(min-width:1270px) 580px, (min-width:1020px) 460px, (min-width:650px) 580px, 100vw" style="object-position:50% 50%;" width="580" height="270" alt="Stellenangebote" title="stellenangebote teaser" />


        <div class="content">
          <div class="title ">Stellenangebote </div>
          <p class="text d">Karriere bei Metten - Stellenangebote und Ausbildungsangebote.</p>

        </div>
      </a>



    </div>
    <div class="loadMore"> Mehr laden </div>
  </div>
</div>



<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>