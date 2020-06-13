<template>
  <div>
    <v-toolbar color="indigo" dark>
      <v-toolbar-title>
        <router-link class="white--text" to="/" >Forum</router-link>
      </v-toolbar-title>

      <v-spacer></v-spacer>

      <div>
         <router-link v-for="item in items" :key="item.title" :to="item.to">
             <template v-if="item.show">
                <v-btn text>{{ item.title }}</v-btn>
             </template>
         </router-link>
      </div>

      <template v-if="$vuetify.breakpoint.smAndUp">
        <app-notification v-if="loggedIn"></app-notification>
        <v-btn icon>
          <v-icon>mdi-delete-circle</v-icon>
        </v-btn>
        <v-btn icon>
          <v-icon>mdi-plus-circle</v-icon>
        </v-btn>
      </template>
    </v-toolbar>
  </div>
</template>

<script>
import AppNotification from './AppNotification'
export default {
  components: {AppNotification},
  data(){
    return {
      loggedIn: User.loggedIn,
      items: [
        { title: 'Forum', to: '/forum', show: true },
        { title: 'Ask Question', to: '/ask', show: User.loggedIn() },
        { title: 'Category', to: '/category', show: User.admin() },
        { title: 'Login', to: '/login', show: !User.loggedIn() },
        { title: 'logout', to: '/logout', show: User.loggedIn() },

      ]
    }
  },
  created(){
    EventBus.$on('logout', () => {
      User.logout()
    })
  }

}
</script>

<style>

</style>
