import api from '../../../api'

export default {
    getConversation ({dispatch, commit}, id) {
        commit('setLoadingConversation', true)

        api.conversation.getConversation(id).then(res => {
          commit('setConversation', res.data.data)
          commit('setLoadingConversation', false)
          window.history.pushState(null, null, `/conversations/${id}`)
        })
    },
    createReply ({dispatch, commit}, {id, body}) {
        return api.conversation.storeReply(id, {body}).then(res => {
          commit('addReply', res.data.data)
          commit('updateConversations', res.data.data.parent.data)
        })
    }
}
