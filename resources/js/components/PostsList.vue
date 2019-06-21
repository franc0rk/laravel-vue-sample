<template>
    <div class="posts-list">
        <div class="card w-100 p-5 my-5" v-for="item in items" :key="item.id">
          <div class="card-body">
            <h5 class="card-title">{{ item.title }} - {{ item.user.name }}</h5>
            <label class="badge badge-info text-white">{{ item.category.name }}</label>
            <p class="card-text">{{ item.body }}</p>
          </div>
          <img class="card-img-top w-50 mx-auto"
            :src="item.attachments[0].path.includes('attachments') ? `http://localhost:8000/${item.attachments[0].path}` : item.attachments[0].path"
            :alt="item.title">
        </div>
    </div>
</template>
<script>
export default {
    created () {
        this.$store.dispatch('fetchPosts')
    },
    computed: {
        items () {
            return this.$store.getters['filteredPosts']
        }
    }
}
</script>
