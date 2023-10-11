<template>
    <div class="shdw p-2 bg-white mb-2 last:mb-0 flex justify-between">
        <div class="flex content-center justify-center flex-wrap">
            <p>Автор: {{`${author.first_name} ${author.last_name}`}}</p>
        </div>
        <div class="flex gap-1">
            <my-button @click="setEditAuthorModal(author)">Редактировать</my-button>
            <my-button @click="setDeleteAuthorModal(author.id)">Удалить</my-button>    
        </div>
    </div>
</template>

<script>
import { mapMutations } from 'vuex'

export default {
    name: 'my-author',
    props: {
        author: Object
    },
    data() {
        return {
            
        }
    },
    methods: {
        ...mapMutations(['setEditAuthorModal', 'setDeleteAuthorModal']),
    }
}
</script>
<style>

</style>
