----------------------------------------
<p><h3>Updates</h3></p>
<p><b>-> New dependecie</b></p>
<p>vue-infinite-loading -- for scroll pagination</p>

<p><b>-> New model (form email verification)</b></p>
<p>Models/VerifyUser.php</p>
<p>Mail/VerifyMail.php</p>

<p>-> Migrations are modified</p>

<p>-> Controllers, components, and routes are modified</p>

<h2>Frontend</h2>

<ul>
<li> MainApp.vue - root</li>
<li>Header.vue</li>
<li>Home.vue</li></ul>

<p><b>Users</b></p>
<ul><li>Login.vue</li>
<li>Register.vue</li>
</ul>

<p><b>ToDo lists in my case Items</b></p>
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
<p><b>dependecies</b></p>
<ul>
  <li>bootstrap-vue</li>
<li>vue-router</li>
<li>vuelidate - form validation</li> 
<li>vuex - store user data and token</li>
  </ul>

<h2>Backend</h2>

<p><b>AuthController.php</b></p>
<p>Controller for login/register/logout users
the lib used for jwt auth is <i>tymon/jwt-auth</i></p>

<p><b>ItemController.php</b></p>
<p>Controller for Adding,editing, deleting, updating todo list items</p>

