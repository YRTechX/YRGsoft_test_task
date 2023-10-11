<template>
<v-overlay
      v-model="isLoading"
      class="align-center justify-center"
      persistent
    >
      <v-progress-circular
        color="primary"
        indeterminate
        size="64"
      ></v-progress-circular>
    </v-overlay>
</template>

<script>
import {mapState, mapMutations} from "vuex"
export default {
    name: 'my-loading',
    props: {
      post: Object
    },
    data(){
        return {
            
        }
    },
    computed: mapState(['isLoading']),
    methods: {
      ...mapMutations(['setDeleteAuthorModal'])
    },
}
</script>

<style>

</style>