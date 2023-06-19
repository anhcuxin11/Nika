export default {
	data() {
		return {
			isModalVisible: false,
			messages: [],
			messageOldest: null,
            candidate: null,
			form: new Form({
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
		showMessage: function (id) {
			let loader = this.$loading.show();
			this.form.candidate_id = id;
            this.form.post(`${companyUrl}/messages/api/${id}/history-scout`)
				.then((res) => {
					let { messages, candidate } = res.data;

					this.candidate = candidate;
					this.messages = messages;
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
            this.form.post(`${companyUrl}/messages/api/send-scout`)
				.then(res => {
					let { message  } = res.data;
					this.messages = [...this.messages, message];
					this.form.content = '';

                    this.$nextTick(() => {
						this.scrollToEnd();
					});
				})
				.catch(() => {
					this.$notify('Unable to send message.', 'error');
				});
		},
        addMark: function(id) {
            this.showLoading(true);
            axios.put(`${companyUrl}/scouts/api/mark/${id}`)
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
        removeMark: function(id) {
            this.showLoading(true);
            axios.delete(`${companyUrl}/scouts/api/mark/${id}`)
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
	},
	computed: {
		displayModal: function () {
		  return this.isModalVisible ? 'block' : 'none';
		},
	}
}
