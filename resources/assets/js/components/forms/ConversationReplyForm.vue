<template>
<form action="#" v-on:submit.prevent="submitReply">
    <div class="form-group">
        <textarea v-model="body" rows="4" cols="30" class="form-control" placeholder="Enter reply..."></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-default">Reply</button>
    </div>
</form>
</template>

<script>
import {
    mapActions,
    mapGetters
} from 'vuex'
export default {
    data() {
        return {
            body: null,
        }
    },
    methods: {
        ...mapActions([
            'createReply'
        ]),
        submitReply() {
            this.createReply({
                id: this.conversation.id,
                body: this.body
            }).then((res) => {
              this.body = null
            })
        }
    },
    computed: {
      ...mapGetters([
        'conversation'
      ])
    }
}
</script>
