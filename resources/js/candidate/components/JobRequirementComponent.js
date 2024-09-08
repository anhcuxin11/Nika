export default {
    props: {
        resumeRequirement: {
            type: Object|Array
        },
        occupations: Array,
        industries: Array,
        locations: Array,
    },
    data() {
        return {
            form: new Form({
                occupation_ids: [],
                industry_ids: [],
                location_ids: [],
                requirementEmployment: [],
                requirementSalary: "",
            }),

            requirementEmployments: [
                { value: 0, name: "Permanent" },
                { value: 1, name: "Contractor" },
                { value: 3, name: "Outsourcing" },
                { value: 4, name: "Contingent worker" },
                { value: 2, name: "Part time" }
            ],
        };
    },
    mounted() {
        //occupation
        this.form.occupation_ids = this.resumeRequirement?.resume?.requirement_occupations.map(
            function($occupation) {
                return $occupation.id;
            }
        ) || [];
        //industry
        this.form.industry_ids = this.resumeRequirement?.resume?.requirement_industries.map(
            function($industry) {
                return $industry.id;
            }
        ) || [];
        //location
        this.form.location_ids = this.resumeRequirement?.resume?.requirement_locations.map(
            function($location) {
                return $location.id;
            }
        ) || [];
        //requirement_employment
        this.form.requirementEmployment = this.resumeRequirement?.resume?.resume_requirement_employments.map(
          function($requirementEmployment) {
            return $requirementEmployment.requirement_employment;
          }
        ) || [];

        //requirement_salary
        this.form.requirementSalary = this.resumeRequirement?.requirement_salary || '';

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
        updateJobRequirement() {
            let loader = this.$loading.show();
            this.form.post(process.env.MIX_API_URL + "/desired-job/api/update")
                .then(res => {
                    loader.hide();
                    this.$notify(res.data.message, 'success');
                })
                .catch((err) => {
                    this.$notify('Update failed', 'error');
                    loader.hide();
                });
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
        },

        locationLabels: function() {
            const ids = this.form.location_ids;
            console.log(ids);
            const selecteds = this.locations
                .filter(o => ids.includes(o.id))
                .map(o => o.name);
            return selecteds.length > 0
                ? selecteds.join(" / ")
                : "";
        },

        requirementEmploymentLabel: function() {
            const ids = this.form.requirementEmployment;
            const selecteds = this.requirementEmployments
                .filter(o => ids.includes(o.value))
                .map(o => o.name);
            return selecteds.length > 0
                ? selecteds.join(" / ")
                : "";
        }
    }
};
