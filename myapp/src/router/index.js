import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import EmployeeView from '@/components/EmployeeView'
import RegisterView from '@/components/RegisterView'
import Login from '@/components/Login'

Vue.use(Router)

export default new Router({
  routes: [

    {
      path: '/empview',
      name: 'EmployeeView',
      component: EmployeeView

    },
    {
      path: '/',
      name: 'LoginView',
      component: Login

    },
    {
      path: '/register',
      name: 'RegisterView',
      component: RegisterView

    },
  ]
})
