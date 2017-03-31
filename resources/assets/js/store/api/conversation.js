export default {
  getConversation(id) {
    return new Promise((resolve, reject) => {
      axios.get(`/webapi/conversations/${id}`).then(res => {
        resolve(res)
      })
    })
  }
}
