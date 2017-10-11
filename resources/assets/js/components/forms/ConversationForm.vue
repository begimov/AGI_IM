<template>
<div class="panel panel-default">
    <div class="panel-heading">
        New message:
    </div>
    <div class="panel-body">
        <form class="form-group" action="#" v-on:submit.prevent="send">
            <ul v-if="recipients.length" class="list-inline">
                <li>To:</li>
                <li v-for="item in recipients"><a href="#" v-on:click.stop.prevent="removeRecipient(item.id)">{{ item.name }}</a></li>
            </ul>
            <div class="form-group">
                <input type="text" id="users" placeholder="Add users..." class="form-control">
            </div>
            <div class="form-group">
                <textarea v-model="body" id="message" rows="4" cols="30" placeholder="Enter message..." class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default">Send</button>
            </div>
        </form>

    </div>
</div>
</template>

<script>
import {
    userAutocomplete
} from '../../helpers/autocomplete'
import {
    mapActions
} from 'vuex'

export default {
    data() {
        return {
            body: null,
            recipients: [],
        }
    },
    methods: {
        ...mapActions([
            'createConversation'
        ]),
        addRecipient(user) {
            this.filterRecipientOut(user.id)
            this.recipients.push(user)
        },
        removeRecipient(id) {
            this.filterRecipientOut(id)
        },
        filterRecipientOut(recepientId) {
            this.recipients = this.recipients.filter(elem => elem.id !== recepientId)
        },
        send() {
            this.createConversation({
                body: this.body,
                recipientIds: this.recipients.map(elem => elem.id)
            }).then(() => {
               this.recipients = []
               this.body = null
            })
        },
    },
    mounted() {
        let users = userAutocomplete('#users', {
            hitsPerPage: 5
        }).on('autocomplete:selected', (event, suggestion, dataset) => {
            this.addRecipient(suggestion)
            users.autocomplete.setVal('')
        })
    }
}
</script>
