export default {
  setConversation (state, conversation) {
    state.conversation = conversation
  },
  setLoadingConversation (state, value) {
    state.loadingConversation = value
  },
  addReply (state, reply) {
    state.conversation.replies.data = [reply, ...state.conversation.replies.data]
  }
}
