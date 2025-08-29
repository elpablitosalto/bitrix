//var canInitCheckListTree = true;
$(document).ready(function () {
    initCheckListTree();
    //alert('!');
});

BX.addCustomEvent('onAjaxSuccess', function (res) {
    //canInitCheckListTree = true;
    initCheckListTree();
});

function initCheckListTree() {
    //if (canInitCheckListTree == true) {
        //canInitCheckListTree = false;
        //alert('!');
        const target = document.querySelector('.js_check_list_tree');
        // target.addEventListener('checklist-init', function (e) {console.log('init', e.data)});
        // target.addEventListener('checklist-update-start', function (e) {console.log('start', e.data)});
        // target.addEventListener('checklist-update-end', function (e) {console.log('end', e.data)});

        //target.addEventListener('checklist-delayed-general-end', function (e) {console.log('1', e.data)});
        //target.addEventListener('checklist-delayed-tick-end', function (e) {console.log('2', e.data)});

        const list = new WAChecklist(target, {
            cookieData: {
                read: false,
                write: false,
                name: 'waChecklistData',
                days: 7
            },
            batchDelay: 600,
            collapseChildren: false,
            redundantActions: true,
            itemEventBubbles: true,
            multipleExpandedOnOneLevel: false,
            //checkPartiallyTickedParents: false,
            collapseLists: {
                enabled: true,
                after: 5,
                buttonTemplate: '<button class="check-list__link" type="button">%TEXT%</button>',
                buttonTextExpand: 'Показать все',
                buttonTextCollapse: 'Свернуть'
            },
            modifiers: {
                itemExpanded: 'check-list__item_state_expanded',
                itemWrapperExpanded: 'check-list__item-wrapper_state_expanded',
                inputTickedPartially: 'check-list__input_state_checked-partially',
                listCollapsed: 'check-list__list_state_collapsed',
                itemCollapseThreshold: 'check-list__item_collapse_threshold'
            }
        });
        // target.addEventListener('checklist-item-collapse', function (e) {console.log('collapsed', e.data.brief.name, e.data.expanded)});
        // target.addEventListener('checklist-item-expand', function (e) {console.log('expanded', e.data.brief.name, e.data.expanded)});
        // target.addEventListener('checklist-item-tick', function (e) {console.log('ticked', e.data.brief.name, e.data.expanded)});
        // target.addEventListener('checklist-item-untick', function (e) {console.log('unticked', e.data.brief.name, e.data.expanded)});
        // target.addEventListener('checklist-tick-end', function (e) {console.log('checklist-update-end', e.data)});
        // target.addEventListener('checklist-expand-end', function (e) {console.log('checklist-update-end', e.data)});
        // target.addEventListener('checklist-delayed-update-end', function (e) {console.log('checklist-delayed-update-end', e.data)});
        // target.addEventListener('checklist-delayed-tick-end', function (e) {console.log('checklist-delayed-tick-end', e.data)});
        target.addEventListener('checklist-delayed-expand-end', function (e) { console.log('checklist-delayed-expand-end', e.data) });
    //}
}