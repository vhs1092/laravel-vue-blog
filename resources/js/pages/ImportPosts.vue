<template>
<div>
    <div class="row post-actions-row float-right mb-4">
        <button class="btn btn-primary" data-save @click="importBlogs">Import Posts</button>
    </div>
    <b-table striped hover :items="items" v-if="items.length > 0" :fields="tableFields"></b-table>
    <div class="row float-right mt-2 mb-4">
        <button class="btn btn-success" v-if="items.length > 0" @click="saveImportedBlogs">Save Posts</button>
    </div>
</div>
</template>

<script>
import {
    mapActions,
    mapGetters
} from 'vuex'

export default {
    name: "ImportPosts",

    data() {
        return {
            tableFields: ['title', 'description', 'publication_date'],
            items: []
        }
    },
    created() {},
    methods: {
        ...mapActions({
            getBlog: 'blog/getBlog',
        }),
        importBlogs(e) {
            e.preventDefault();

            this.$store.dispatch('blog/importBlogs')
                .then((response) => {
                    this.items = response.data;
                })
                .catch((e) => {
                    this.$flash.error({
                        title: 'New Post',
                        text: 'Error occured saving the story'
                    })
                })

        },
        saveImportedBlogs(e) {
            e.preventDefault();

            this.$store.dispatch('blog/saveImportedBlogs', this.items)
                .then((response) => {
                    this.$flash.success({title: 'New Post', text: 'Post saved successfully'})
                })
                .catch((e) => {
                    this.$flash.error({
                        title: 'New Post',
                        text: 'Error occured saving the story'
                    })
                })

        }
    }
}
</script>

<style scoped>

</style>
