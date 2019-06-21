<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Nuevo post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="save">
                <div class="form-group">
                    <label>Titulo</label>
                    <input type="text" class="form-control" v-model="form.title">
                </div>
                <div class="form-group">
                    <label>Contenido</label>
                    <textarea class="form-control" v-model="form.body"></textarea>
                </div>
                <div class="form-group">
                    <label>Imagen</label>
                    <input type="file" class="form-control p-5" ref="attachment">
                </div>
                <div class="form-group">
                    <label>Categoria</label>
                    <select class="d-inline-block form-control w-25 ml-5" v-model="form.category_id">
                        <option value="">Categoria</option>
                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" @click="save">Publicar</button>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
export default {
    data: () => ({
        form: {
            title: '',
            body: '',
            attachment: '',
            category_id: ''
        }
    }),
    methods: {
        save () {
            let payload = new FormData()

            payload.append('attachment', this.$refs['attachment'].files[0])

            _.each(this.form, (val, key) => {
                payload.append(key, val)
            })

            this.$store.dispatch('savePost', payload)
                .then(() => {
                    $('.close').click()
                    $('.modal-backdrop').hide()
                    this.resetForm()
                })
                .catch(err => alert(err))
        },
        resetForm () {
            this.form = {
                title: '',
                body: '',
                attachment: '',
                category_id: ''
            }

            const fileInput = this.$refs['attachment']
            fileInput.type = 'text'
            fileInput.type = 'file'
        }
    },
    computed: {
        categories () {
            return this.$store.getters['categories']
        }
    }
}
</script>
