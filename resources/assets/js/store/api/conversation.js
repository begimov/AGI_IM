export default {
  getConversation(id) {
    return new Promise((resolve, reject) => {
      axios.get(`/webapi/conversations/${id}`).then(res => {
        resolve(res)
      })
    })
  },
  storeReply(id, {body}) {
    return new Promise((resolve, reject) => {
      axios.post(`/webapi/conversations/${id}/reply`, {
        body: body
      }).then(res => {
        resolve(res)
      })
    })
  }
}
