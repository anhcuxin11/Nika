import { remove } from 'lodash';
import axios from 'axios';

export default {
    props: ['jobs'],

    data() {
        return {
          selectedIds: [],
          status: '',
          checkAllStatus: false
        };
    },

    methods: {
        showLoading: function(status) {
            if(status){
                this.$loading.show();

            }else{
                this.$loading.hide();
            }
        },

        checkAll: function(e) {
            let { checked } = e.target;
            let jobIds = this.jobs.map((o) => o.id);

            this.selectedIds = checked ? jobIds : [];
            this.checkAllStatus = checked;
        },

        onChangeCheckbox: function(e) {
            let { value } = e.target;
            let ids = [...this.selectedIds];
            value = Number(value);

            if(ids.includes(value)){
                remove(ids, (o) => o == value);
            }else{
                ids.push(value);
            }

            this.checkAllStatus = (ids.length == this.jobs.length);
            this.selectedIds = ids;
        },

        onSubmitStatus: function() {
            let formData = {
            'job_ids': this.selectedIds,
            'status': this.status
            };

            this.showLoading(true);

            axios.put(`${companyUrl}/jobs/api/statuses/update`,formData)
                .then(res => {
                    this.$notify(res.data.message, 'success');
                    setTimeout(() => window.location.reload(), 500);
                })
                .catch(err => {
                    let { message } = err.data;
                    this.showLoading(false);
                    this.$notify(message, 'error');
                });
        },

        onChangeStatus: function(id, status) {
            this.showLoading(true);
            axios.put(`${companyUrl}/jobs/api/status/${id}/update/${status}`)
                .then(res => {
                        this.$notify(res.data.message, 'success');
                        setTimeout(() => window.location.reload(), 500);
                })
                .catch(err => {
                    let { message } = err.data;
                    this.showLoading(false);
                    this.$notify(message, 'error');
                });
        }
    }
};
