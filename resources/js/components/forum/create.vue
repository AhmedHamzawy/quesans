<template>
    <v-container>
    <v-form
    ref="form"
    @submit.prevent="create"
    lazy-validation
     >
    
    <span class="red--text" v-if="errors.title">{{ errors.title[0] }}</span>
    <v-text-field
      v-model="form.title"
      label="Title"
      type="text"
      required
    ></v-text-field>   

    <span class="red--text" v-if="errors.category_id">{{ errors.category_id[0] }}</span>
    <v-select
    :items= "categories"
    item-text="name"
    item-value="id"
    v-model= "form.category_id"
    label= "Category"
    autocomplete
    >

    </v-select>

    <span class="red--text" v-if="errors.body">{{ errors.body[0] }}</span>
    <vue-simplemde v-model="form.body" ref="markdownEditor" />


    <v-btn
      color="green"
      type="submit"
      :disabled="disabled"    
    >
      Create
    </v-btn>

    </v-form>

    </v-container>
</template>

<script>
export default {
    data(){
        return{
            form:{
                title: '',
                category_id: '',
                body: ''
            },
            categories: {},
            errors: {}
        }
    },
    created(){
        axios.get('/api/category')
        .then(res => this.categories = res.data.data)
    },
    methods:{
        create(){
            axios.post('/api/question', this.form)
            .then(res => this.$router.push(res.data.path))
            .catch(error => this.errors = error.response.data.errors)
        }
    },
    computed:{
        disabled(){
            return !(this.title&&this.body&&this.category_id)
        }
    }
}
</script>

<style>

</style>
