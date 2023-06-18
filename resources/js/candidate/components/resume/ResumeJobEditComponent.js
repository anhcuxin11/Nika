export default {
    props: {
        job: {
            require: true,
            type: Object|Array
        },
        occupations: {
            require: true,
            type: Array
        },
        industries: {
            require: true,
            type: Array
        }
    },
    data() {
        return {
            form: new Form({
                certificate: '',
                skill: '',
                industry_ids: [],
                occupation_ids: [],
                current_salary: '',
                name: '',
                type: 'resume',
                attachment: null
            }),
        }
    },
    mounted() {
        this.form.certificate = this.job.certificate || '';
        this.form.skill = this.job.skill || '';
        this.form.current_salary = this.job.current_salary || '';

        //occupation
        this.form.occupation_ids = this.job.occupations.map(
            function($occupation) {
                return $occupation.id;
            }
        ) || [];

        //industry
        this.form.industry_ids = this.job.industries.map(
            function($industry) {
                return $industry.id;
            }
        ) || [];

        // Handle event on modal
        $(function() {
            $('.select-all').each(function() {
                let target = $(this).data('target');
                let $checkboxes = $(target);
                let $checkedboxes = $(`${target}:checked`);
                let status = ($checkboxes.length > 0) && ($checkedboxes.length == $checkboxes.length);
                $(this).prop("checked", status);
            });
        })
    },
    methods: {
        onChangeCheckbox(name, value) {
            this.$set(this.form, name, value);
        },
        updateResumeJob() {
            let loader = this.$loading.show();
            this.form.post(`${candidateUrl}/resumes/${this.job.id}/experience/update`)
                .then(res => {
                    loader.hide();
                    this.$notify(res.data.message, 'success');
                })
                .catch((err) => {
                    this.$notify('Update failed', 'error');
                    loader.hide();
                });
        },
        handleFile(event) {
			let file = event.target.files[0];
			this.form.name = file.name;
			this.form.attachment = file;
		},
    },
    computed: {
        occupationLabels: function() {
            const ids = this.form.occupation_ids;
            const occupationChildrens = this.occupations
                .map(o => o.childrens)
                .flat();
            const selecteds = occupationChildrens
                .filter(o => ids.includes(o.id))
                .map(o => o.name);
            return selecteds.length > 0
                ? selecteds.join(" / ")
                : "";
        },

        industryLabels: function() {
            const ids = this.form.industry_ids;
            const industryChildrens = this.industries
                .map(o => o.childrens)
                .flat();
            const selecteds = industryChildrens
                .filter(o => ids.includes(o.id))
                .map(o => o.name);
            return selecteds.length > 0
                ? selecteds.join(" / ")
                : "";
        }
    }
}
