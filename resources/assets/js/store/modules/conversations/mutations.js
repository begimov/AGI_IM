export default {
  setConversations (state, conversations) {
    state.conversations = conversations
  },
  setLoadingConversations (state, value) {
    state.loadingConversations = value
  },
  updateConversations (state, conversation) {
    state.conversations = state.conversations.filter(item => item.id !== conversation.id)
    state.conversations = [conversation, ...state.conversations]
  }
}
