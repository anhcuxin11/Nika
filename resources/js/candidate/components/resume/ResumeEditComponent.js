export default {
    props: {
        resume: {
            require: true,
            type: Object|Array
        }
    },
    data() {
        return {
            form: new Form({
                lastname: '',
                firstname: '',
                age: '',
                phone: '',
                country: '',
                address: '',
                facebook: 'resume',
                hobby: null
            }),
        }
    },
    mounted() {
        this.form.lastname = this.resume.candidate.lastname || '';
        this.form.firstname = this.resume.candidate.firstname || '';
        this.form.age = this.resume.age || '';
        this.form.phone = this.resume.phone || '';
        this.form.country = this.resume.country || '';
        this.form.address = this.resume.address || '';
        this.form.facebook = this.resume.facebook || '';
        this.form.hobby = this.resume.hobby || '';
    },
    methods: {
        updateResume() {
            let loader = this.$loading.show();
            this.form.post(`${candidateUrl}/resumes/${this.resume.id}/update`)
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
}
