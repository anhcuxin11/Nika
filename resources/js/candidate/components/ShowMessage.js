export default {
	data() {
		return {
			isModalVisible: false,
			messages: [],
			messageOldest: null,
            candiate: null,
            company: null,
			job: null,
			form: new Form({
				job_id: null,
				company_id: null,
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
			this.form.job_id = id;
            this.form.post(`${candidateUrl}/messages/api/${id}/history`)
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
			// let container = document.querySelector("#candidate-chat-messages");
			let chatArea = document.querySelector("#chat-area");
			container.scrollTop = container.scrollHeight;
			chatArea.scrollTop = chatArea.scrollHeight;
			// container1.scrollTop = container1.scrollHeight;
		},
		onSendMessage: function () {
            this.form.post(`${candidateUrl}/messages/api/send`)
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
        showCompanyMessage: function (id) {
			let loader = this.$loading.show();
			this.form.company_id = id;
            this.form.post(`${candidateUrl}/messages/api/${id}/company`)
				.then((res) => {
					let { messages, company } = res.data;

					this.company = company;
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
        onSendCompanyMessage: function () {
            this.form.post(`${candidateUrl}/messages/api/send-company`)
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
	},
	computed: {
		displayModal: function () {
		  return this.isModalVisible ? 'block' : 'none';
		},
		onSendMessageEnable: function () {
            return this.company.status == 1;
		},
	}
}
