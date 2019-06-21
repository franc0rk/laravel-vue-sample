<template>
    <div class="metrics">
        <div class="card text-white bg-primary d-inline-block" style="max-width: 18rem;">
          <div class="card-header">Today posts</div>
          <div class="card-body">
            <h5 class="card-title">{{ todayPosts }} posts</h5>
            <p class="card-text">Han sido publicados hoy</p>
          </div>
        </div>
        <div class="card text-white bg-secondary d-inline-block" style="max-width: 18rem;">
          <div class="card-header">Posts by category</div>
          <div class="card-body">
            <h5 class="card-title">
                <span v-for="(category, categoryIndex) in postsByCategory" :key="categoryIndex" class="d-block">
                    {{ category }}
                </span>
            </h5>
            <p class="card-text">Posts por categoria</p>
          </div>
        </div>
    </div>
</template>
<script>
export default {
    computed: {
        todayPosts () {
            return this.$store.getters['todayPosts']
        },
        postsByCategory () {
            return this.$store.getters['postsByCategory']
        }
    }
}
</script>
