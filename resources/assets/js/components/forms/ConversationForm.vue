<template>
<div class="panel panel-default">
    <div class="panel-heading">
        New message:
    </div>
    <div class="panel-body">
        <div class="form-group">
            <input type="text" id="users" placeholder="Add users..." class="form-control">
        </div>
    </div>
</div>
</template>

<script>
import { userAutocomplete } from '../../helpers/autocomplete'
export default {
    mounted() {
      userAutocomplete('#users', {
        hitsPerPage: 5
      })
    }
}
</script>
