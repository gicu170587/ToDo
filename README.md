<h2>Frontend</h2>
<p>
<h4>Vue components</h4>
<ul>
  <li> MainApp.vue - root</li>
<li>Header.vue</li>
<li>Home.vue</li></ul>
<p><i>Users</i></p>
<ul><li>Login.vue</li>
<li>Register.vue</li>
</ul>

<p><i>ToDo lists in my case Items</i></p>
<ul>
  <li>ListItems.vue - all items imported in home</li>
<li>ListItem.vue - child of ListItems.vue</li>
<li>EditItem.vue - page for view and editing Items</li>
<li>ItemAdd.vue -  add new ToDo</li>
  </ul>
</p>

<p>Axios requests are in separate file <br />
js/partials/axiosController.js
</p>
<p>All vue routes <br />
/js/routes.js
</p>
<p>User data<br />
/js/store.js
</p>
<p><i>dependecies</i></p>
<ul>
  <li>bootstrap-vue</li>
<li>vue-router</li>
<li>vuelidate - form validation</li> 
<li>vuex - store user data and token</li>
  </ul>

<h2>Backend</h2>
