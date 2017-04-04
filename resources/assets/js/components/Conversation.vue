<template>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="loader" v-if="getLoadingConversation"></div>
        <div v-else-if="conversation">
            <ul class="list-inline" v-if="conversation.users.data.length">
                <li>In chat:</li>
                <li v-for="user in conversation.users.data">{{ user.name }}</li>
            </ul>
            <conversation-reply-form></conversation-reply-form>
            <!-- replies -->
            <div class="media" v-for="item in conversation.replies.data">
                <div class="media-left">
                    <img class="media-object" v-bind:src="item.user.data.avatar" alt="">
                </div>
                <div class="media-body">
                    <h5>{{ item.user.data.name }} - {{ item.created_at_human }}</h5>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{ item.body }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- first message -->
            <div class="media">
                <div class="media-left">
                    <img class="media-object" v-bind:src="conversation.user.data.avatar" alt="">
                </div>
                <div class="media-body">
                    <h5>{{ conversation.user.data.name }} - {{ conversation.created_at_human }}</h5>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{ conversation.body }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>No chat selected...</div>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapGetters
} from 'vuex'
export default {
    computed: {
        ...mapGetters([
            'conversation',
            'getLoadingConversation'
        ])
    },
    methods: {
        ...mapActions([
            'getConversation'
        ])
    },
    props: ['id'],
    mounted() {
        if (this.id !== null) {
            this.getConversation(this.id)
        }
    }
}
</script>
