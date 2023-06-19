export default {
	data() {
		return {
			isModalVisible: false,
			messages: [],
			messageOldest: null,
            company: null,
			job: null,
			form: new Form({
				job_id: null,
				candidate_id: null,
				content: ''
			}),
			showModal: false,
		}
	},
	methods: {
		closeModal() {
		  document.querySelector('body').style.overflow = 'auto';
		  this.isModalVisible = false;
		},
		nl2br: function nl2br(str, is_xhtml) {
			if (typeof str === 'undefined' || str === null) {
				return '';
			}
			var breakTag = is_xhtml || typeof is_xhtml === 'undefined' ? '<br />' : '<br>';
			return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
		},
		showMessage: function (id,c_id) {
			let loader = this.$loading.show();
			this.form.job_id = id;
			this.form.candidate_id = c_id;
            this.form.post(`${companyUrl}/messages/api/${id}/history/${c_id}`)
				.then((res) => {
					let { job, messages, company } = res.data;

					this.company = company;
					this.messages = messages;
					this.job = job;
					this.showModal = true;
					this.isModalVisible = true;
					loader.hide();
					document.querySelector('body').style.overflow = 'hidden';
                    this.$nextTick(() => {
						// Scroll down
						this.scrollToEnd();
					})
				})
				.catch((xhr) => {
					this.showModal = false;
					loader.hide();
				});
		},
        scrollToEnd: function () {
			let container = document.querySelector("#candidate-chat-messages");
			let chatArea = document.querySelector("#chat-area");
			container.scrollTop = container.scrollHeight;
			chatArea.scrollTop = chatArea.scrollHeight;
		},
		onSendMessage: function () {
            this.form.post(`${companyUrl}/messages/api/send`)
				.then(res => {
					// let { data: { message } } = res.data;
					let { message  } = res.data;
					this.messages = [...this.messages, message];
                    console.log(this.messages);
					this.form.content = '';

                    this.$nextTick(() => {
						this.scrollToEnd();
					});
				})
				.catch(() => {
					this.$notify('Unable to send message.', 'error');
				});
		},
        updateStatus: function(id, status) {
            this.showLoading(true);
            axios.put(`${companyUrl}/applications/api/status/${id}/update/${status}`)
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
        showLoading: function(status) {
            if(status){
                this.$loading.show();

            }else{
                this.$loading.hide();
            }
        },
        like: function(id, status) {
            this.showLoading(true);
            axios.put(`${companyUrl}/favorites/api/status/${id}/update/${status}`)
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
        mark: function(id, status) {
            this.showLoading(true);
            axios.put(`${companyUrl}/favorites/api/mark/${id}/update/${status}`)
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
	},
	computed: {
		displayModal: function () {
		  return this.isModalVisible ? 'block' : 'none';
		},
		onSendMessageEnable: function () {
            return this.company.status == 2;
		},
	}
}
