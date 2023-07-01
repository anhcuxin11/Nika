<div class="modal modal_outer right_modal form-message fade" :class="{'show' : isModalVisible}"
  tabindex="-1" role="dialog"
  :aria-hidden="!isModalVisible"
  :aria-modal="isModalVisible"
  :style="{ display: displayModal}"
  aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <a data-dismiss="modal" aria-label="Close" @click="closeModal">
                        <img src="{{ asset('images/icon-arrow-line-right-white.svg') }}" class="close-btn">
                    </a>
                </div>
                <div class="modal-body" id="candidate-chat-messages" v-if="showModal">
                    <div class="title-area">
                        <div class="title" v-if="job" v-text="job.job_title"></div>
                        <a v-if="job" target="_blank" :href="route('candidate.job.show', job.id)" class="ext-link">
                            <img src="{{ asset('images/icon-external.svg') }}">Show job
                        </a>
                    </div>
                    <div class="chat-area text-break" id="chat-area" style="height: 352px; overflow: auto;">
                        <div class="chat-row" v-for="item in messages">
                            <div :class="{ left: item.type == 1, right: item.type == 2 }">
                                <span class="msg" v-text="item.text"></span>
                            </div>
                            <div v-if="item.type == 1" class="date-time-left" v-html="`<span>${item.created_at}</span>`">
                            </div>
                            <div v-else class="date-time-right">
                                <span v-html="`${item.created_at}`"></span>
                            </div>
                        </div>
                        <div class="chat-row"></div>
                    </div>
                    <div class="form-single">
                        <form method="" action="" class="d-flex align-items-center" @submit.prevent="onSendMessage" style="column-gap: 5px;">
                            <textarea v-model="form.content" rows="2" class="form-control" placeholder="Enter your message" :disabled="form.busy"></textarea>
                            <button type="submit" class="btn btn-purple" style="min-width: 0px; min-height: 0px; padding: 14px 20px;" :disabled="form.busy">
                                <img src="{{ asset('images/icon-plane-white.svg') }}">Send
                            </button>
                        </form>
                    </div>
                </div>
            </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
