import api from '../../api'

export default {
  getConversations ({dispatch, commit}, page) {
    commit('setLoadingConversations', true)

    api.conversations.getConversations(1).then(res => {
      commit('setConversations', res.data.data)
      commit('setLoadingConversations', false)
    })
  }
}
