import state from './state'
import getters from './getters'
import actions from './actions'
import mutations from './mutations'
import conversation from './conversation'

export default {
  state,
  getters,
  actions,
  mutations,
  modules: {
    conversation: conversation
  }
}
