<template>
    <nav class="d-flex flex-column bg-light vh-100 p-3">
      <div>
        <h5>Menu</h5>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="#">Pessoas</a>
          </li>
        </ul>
      </div>
      <div class="mt-auto p-3">
        <hr />
        <div class="d-flex justify-content-between align-items-center">
          <UserInfo></UserInfo>
          <LogoutButton></LogoutButton>
        </div>
      </div>
    </nav>
  </template>
  
  <script>
import LogoutButton from './User/LogoutButton.vue';
import UserInfo from './User/UserInfo.vue';

  export default {
    name: 'SideBar',
    components: {
        LogoutButton,
        UserInfo
    }
  };
  </script>
  
  <style scoped>
  .vh-100 {
    height: 100%;
  }
  </style>
  