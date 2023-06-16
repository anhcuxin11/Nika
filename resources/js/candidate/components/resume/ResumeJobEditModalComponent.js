export default {
	props: [
		"occupations",
        "industries",
        "form",
        "changeCheckbox",
        "occupationLabels",
        "industryLabels",
	],
    methods: {
        selectAll(e) {
            let $el = $(e.target);
            let $target = $($el.data("target"));
            let name = $target.data("form");
            $target.prop("checked", e.target.checked);
            let multiple = $target.attr("multiple");
            let value = null;
            if (multiple) {
                value = $(`input[data-form="${name}"]:checked`)
                    .toArray()
                    .map(o => parseInt(o.value));
            } else {
                value = $target.val();
            }
            this.changeCheckbox(name, value);
        },
        childrenChange(e) {
            let $el = $(e.target);
            let $container = $el.closest(".list-children");
            let $parent = $($el.data("parent"));
            let status = $container.find('input[type="checkbox"]').length > 0
                    && $container.find('input[type="checkbox"]:checked').length == $container.find('input[type="checkbox"]').length;
            $parent.prop("checked", status);
            let name = $el.data("form");
            let multiple = $el.attr("multiple");
            let value = null;
            if (multiple) {
                value = $(`input[data-form="${name}"]:checked`)
                    .toArray()
                    .map(o => parseInt(o.value));
            } else {
                value = $el.val();
            }
            this.changeCheckbox(name, value);
        },
        closeModal () {
            $('.modal').modal('hide');
        }
    }
}
