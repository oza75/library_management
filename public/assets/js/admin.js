const flash = window.flash = function (type, value) {
    let container = document.querySelector('#flash-container .wrapper');
    let flash = document.createElement('div');
    flash.classList.add('flash', 'flash-' + type);
    flash.innerHTML = value;
    container.appendChild(flash);
    let timer = null;
    flash.addEventListener('dblclick', function () {
        flash.parentNode.removeChild(flash);
        clearTimeout(timer);
    });
    timer = setTimeout(function () {
        flash.parentNode.removeChild(flash);
    }, 10 * 1000)
};
const selectAll = function (selector, parent) {
    parent = parent || document;
    return [].slice.call(parent.querySelectorAll(selector));
};

const listTable = function () {
    const elements = selectAll('.list-table-wrapper');

    elements.forEach(function (element) {
        let groupActions = element.querySelector('.group-actions-wrapper');
        let selectAllCheckbox = element.querySelector('.select-all-checkbox');
        const trs = selectAll('tbody tr', element);
        let selectedInput = document.createElement('input');
        selectedInput.type = 'hidden';
        selectedInput.value = "";
        selectedInput.name = "selected";
        let sortByInput = document.createElement('input');
        sortByInput.type = 'hidden';
        sortByInput.name = "sort_by";
        sortByInput.value = element.dataset.pk;
        let sortByInputOrdering = document.createElement('input');
        sortByInputOrdering.type = "hidden";
        sortByInputOrdering.name = "sort_type";
        sortByInputOrdering.value = "asc";
        let actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        element.appendChild(actionInput);
        element.appendChild(selectedInput);
        element.appendChild(sortByInput);
        element.appendChild(sortByInputOrdering);

        const getTrFromCheckbox = function (checkBox) {
            let parent = checkBox.parentNode;
            let max = 8;
            while (parent.nodeName !== 'TR' && max > 0) {
                parent = parent.parentNode;
                max--;
            }
            return parent;
        };

        let allCheckbox = selectAll('input[type="checkbox"]:checked');
        allCheckbox.forEach(function (ch) {
            let tr = getTrFromCheckbox(ch);
            if (tr)
                tr.classList.add('selected');
        });
        let values = [...allCheckbox.map(el => el.value)];
        if (groupActions) {
            groupActions.querySelectorAll('button[type="button"]').forEach(function (item) {
                item.addEventListener('click', function () {
                    actionInput.value = this.dataset.action;
                    element.submit();
                })
            })
        }
        element.querySelectorAll('thead th.sortable').forEach(function (th) {
            let sortKey = th.dataset.sortkey;
            let sortType = th.dataset.sorttype;
            if (parseInt(sortKey)) {
                let icon = th.querySelector(sortType === 'desc' ? '.sort-down' : '.sort-up');
                if (icon) icon.style.display = 'inline';
            } else {
                let icon = th.querySelector('.sort-normal');
                if (icon) icon.style.display = 'inline';
            }

            th.addEventListener('click', function () {
                sortByInput.value = th.dataset.column;
                sortByInputOrdering.value = sortType === 'normal' ? 'asc' : (sortType === 'desc' ? 'asc' : 'desc');
                element.submit();
            })
        });
        const setGroupActions = function () {
            if (!groupActions) return;
            if (values.length > 1) {
                groupActions.querySelectorAll('span.amount').forEach(function (s) {
                    s.innerText = values.length;
                });
                groupActions.style.opacity = 1;
                groupActions.style.visibility = "visible";
            } else {
                groupActions.style.opacity = 0;
                groupActions.style.visibility = "hidden";
            }
        };
        const select = function (checkBox, tr) {
            let value = checkBox.value;
            let i = values.findIndex(v => v == value);
            if (~i) {
                values.splice(i, 1);
                tr.classList.remove('selected');
                checkBox.checked = false;
            } else {
                values.push(value);
                tr.classList.add('selected');
                checkBox.checked = true;
            }
            selectedInput.value = values.join(',');
            setGroupActions();
            if (selectAllCheckbox) selectAllCheckbox.checked = values.length === trs.length;
        };


        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function () {
                values = [];
                if (this.checked) {
                    selectAll('tbody tr input[type="checkbox"]', element).forEach(function (ch) {
                        ch.checked = true;
                        values.push(ch.value);
                    });
                } else {
                    selectAll('tbody tr input[type="checkbox"]', element).forEach(function (ch) {
                        ch.checked = false;
                    });
                }
                selectedInput.value = values.join(',');
                setGroupActions();
            });
            selectAllCheckbox.checked = values.length === trs.length;
        }

        setGroupActions();

        trs.forEach(function (tr) {

            let checkBox = tr.querySelector('input[type="checkbox"]');
            if (checkBox) {
                checkBox.addEventListener('change', function () {
                    select(this, tr);
                })
            }
            tr.addEventListener('click', function () {
                let checkbox = tr.querySelector('input[type="checkbox"]');
                if (!checkbox) return;
                select(checkbox, tr);
            });
        })
    })
};

document.addEventListener('DOMContentLoaded', function () {
    listTable();
});