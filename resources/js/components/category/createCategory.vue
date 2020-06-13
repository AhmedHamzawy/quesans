<template>
    <v-container>
        <v-alert v-if="errors" type="error">
           Please Give Category Name
        </v-alert>
        <v-form @submit.prevent="submit">
            <v-text-field
            v-model="form.name"
            label="Category Name"
            type="text"
            required
            ></v-text-field>

            <v-btn
            color="green"
            type="submit" 
            :disabled="disabled"
            v-if="!editSlug"   
            >
            Create
            </v-btn>

            <v-btn
            v-else
            color="pink"
            type="submit"  
            :disabled="disabled"  
            >
            Update
            </v-btn>
        </v-form>

        <v-card>
            <v-toolbar color="indigo" dark>
                <v-toolbar-title>Categories</v-toolbar-title>
            </v-toolbar>

            <v-list>
                <div v-for="(category,index) in categories" :key="category.id">
                    <v-list-item>
                        <v-list-item-action>
                            <v-btn icon small>
                                <v-icon color="orange" @click="edit(index)">mdi-edit</v-icon>
                            </v-btn>
                            <v-btn icon small @click="destroy(category.slug,index)">
                                <v-icon color="red">mdi-delete</v-icon>
                            </v-btn>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>
                                {{ category.name }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-divider></v-divider>
                </div>
                
            </v-list>
        </v-card>
    </v-container>
</template>

<script>
export default {
    data(){
        return{
            form:{
                name: null
            },
            categories: {},
            editSlug: null,
            errors: null,
        }
    },
    created(){
            if(!User.admin()){
                this.$router.push('/forum')
            }
            axios.get('api/category')
            .then(res => this.categories = res.data.data)
    },
    methods:{
        submit(){
            this.editSlug ? this.update() : this.create()
        },
        destroy(slug,index){
            axios.delete(`/api/category/${slug}`)
            .then(res => this.categories.splice(index, 1))
            .catch(errors => console.log(errors))
        },
        edit(index){
            this.form.name = this.categories[index].name 
            this.editSlug = this.categories[index].slug
            this.categories.splice(index,1)
        },
        create(){
             axios.post('/api/category', this.form)
            .then(res => {
                console.log(res.data)
                this.categories.unshift(res.data)
                this.form.name = null
            })
            .catch(error => this.errors = error.res.data.errors)
        },
        update(){
             axios.patch(`/api/category/${this.editSlug}`, this.form)
            .then(res => {
                console.log(res.data)
                this.categories.unshift(res.data)
                this.form.name = null
            })
        }
    },
    computed:{
        disabled(){
            return !this.form.name
        }
    }
}
</script>

<style>

</style>
