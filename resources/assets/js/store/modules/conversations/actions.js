import api from '../../api'

export default {
  getConversations ({dispatch, commit}, page) {
    api.conversations.getConversations(1).then(res => {
      commit('setConversations', res.data.data)
    })
  }
}
