export default {
  getConversations(page) {
    return new Promise((resolve, reject) => {
      axios.get(`webapi/conversations?page=${page}`).then(res => {
        resolve(res)
      })
    })
  }
}
