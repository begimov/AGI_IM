<template>
<div class="panel panel-default">
    <div class="panel-heading">
        Chats:
    </div>
    <div class="panel-body">
        <div class="media" v-for="item in allConversations">
            <div class="media-left">
                <a href="#">
                    <img class="media-object" v-bind:src="item.user.data.avatar" alt="">
                </a>
            </div>
            <div class="media-body">
                <a href="">
                    <h4 class="media-heading">{{ item.user.data.name }}</h4> {{ item.body }}
                </a>
                <p class="text-muted">{{ item.participant_count + 1 }} users</p>
                <ul class="list-inline">
                    <li><img v-bind:src="user.avatar" v-bind:title="user.name" v-for="user in item.users.data"></li>
                    <li>{{ item.last_reply_human }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapGetters
} from 'vuex'
export default {
    methods: {
        ...mapActions([
            'getConversations'
        ])
    },
    mounted() {
        this.getConversations(1)
    },
    computed: {
        ...mapGetters([
            'allConversations'
        ])
    }
}
</script>
