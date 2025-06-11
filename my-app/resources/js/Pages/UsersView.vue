<template>
      <div class="user-container">
        <div class="section-title"><span>ALL USERS</span></div>
  
        <div class="user-list responsive-table">
            <table class="user-table">
                <thead>
                    <tr>
                        <th @click="sortBy('id')" :class="['sortable', sortKey === 'id' ? 'active' : '']">
                            #
                            <span class="sort-icon" v-if="sortKey === 'id'">{{ sortAsc ? '▲' : '▼' }}</span>
                        </th>

                        <th @click="sortBy('name')" :class="['sortable', sortKey === 'name' ? 'active' : '']">
                            Name
                            <span class="sort-icon" v-if="sortKey === 'name'">{{ sortAsc ? '▲' : '▼' }}</span>
                        </th>
                        <th @click="sortBy('username')" :class="['sortable', sortKey === 'username' ? 'active' : '']">
                            Username
                            <span class="sort-icon" v-if="sortKey === 'username'">{{ sortAsc ? '▲' : '▼' }}</span>
                            </th>
                        <th @click="sortBy('email')" :class="['sortable', sortKey === 'email' ? 'active' : '']">
                            Email
                            <span class="sort-icon" v-if="sortKey === 'email'">{{ sortAsc ? '▲' : '▼' }}</span>
                        </th>
                        <th @click="sortBy('role')" :class="['sortable', sortKey === 'role' ? 'active' : '']">
                            Role
                            <span class="sort-icon" v-if="sortKey === 'role'">{{ sortAsc ? '▲' : '▼' }}</span>
                        </th>
                        <th @click="sortBy('formatted_created_at')" :class="['sortable', sortKey === 'formatted_created_at' ? 'active' : '']">
                            Joined
                            <span class="sort-icon" v-if="sortKey === 'formatted_created_at'">{{ sortAsc ? '▲' : '▼' }}</span>
                        </th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                <tbody>
                    <tr v-for="user in localUsers" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.username }}</td>
                        <td >{{ user.email }}</td>
                        <td>{{ user.role }}</td>
                        <td>{{ user.formatted_created_at }}</td>
                        <td>
                            <button
                                v-if="auth.user && auth.user.id !== user.id"
                                @click="deleteUser(user.id)"
                                class="delete-btn"
                                title="Delete user"
                            >
                                <span class="material-icons">delete</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>

      </div>
</template>
  
<script>
import DefaultLayout from '../Layouts/DefaultLayout.vue';
import axios from 'axios';

export default {
  layout: DefaultLayout,
  props: {
    users: Array,
    auth: Object,
  },
  data() {
    return {
      sortKey: 'id',
      sortAsc: true,
      localUsers: [...this.users],
    };
  },
  methods: {
    sortBy(key) {
      if (this.sortKey === key) {
        this.sortAsc = !this.sortAsc;
      } else {
        this.sortKey = key;
        this.sortAsc = true;
      }

      this.localUsers.sort((a, b) => {
        let valA = a[key];
        let valB = b[key];

        if (typeof valA === 'string') valA = valA.toLowerCase();
        if (typeof valB === 'string') valB = valB.toLowerCase();

        if (valA < valB) return this.sortAsc ? -1 : 1;
        if (valA > valB) return this.sortAsc ? 1 : -1;
        return 0;
      });
    },
    async deleteUser(id) {
      if (id === this.auth.user.id) {
        alert("You cannot delete your own account.");
        return;
      }

      if (confirm('Are you sure you want to delete this user?')) {
        try {
          await axios.delete(`/users/${id}`);
          this.localUsers = this.localUsers.filter(user => user.id !== id);
        } catch (error) {
          console.error("Failed to delete user:", error);
          alert("Something went wrong.");
        }
      }
    }
  }
}
</script>


<style scoped>
.user-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  padding-inline: 50px;
  box-sizing: border-box;
  width: 100%;
}

.section-title {
  font-size: 32px;
  font-weight: 600;
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
  color: #000000;
}

.user-list {
  width: 100%;
  overflow-x: auto;
}

th.sortable {
  cursor: pointer;
  user-select: none;
  position: relative;
  white-space: nowrap;
  background-color: #f44040;
  color: white;
}

th.sortable.active {
  background-color: #d73838;
}

.sort-icon {
  margin-left: 5px;
  font-size: 12px;
}


.user-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 8px;
}

.user-table th,
.user-table td {
  padding: 10px;
  border-bottom: 1px solid #ccc;
  text-align: left;
}

.user-table th {
  background-color: #f44040;
  color: #fff;
  white-space: nowrap;
}

.delete-btn {
  background: none;
  border: none;
  color: #f44040;
  cursor: pointer;
  padding: 5px;
  transition: color 0.2s ease;
}

.delete-btn:hover {
  color: #c12f2f;
}

.material-icons {
  font-size: 20px;
}

/* Fully responsive version for small screens */
@media (max-width: 768px) {
  .user-table,
  .user-table thead,
  .user-table tbody,
  .user-table th,
  .user-table td,
  .user-table tr {
    display: block;
    width: 100%;
  }

  .user-table thead {
    display: none;
  }

  .user-table tr {
    margin-bottom: 15px;
    border: 1px solid #ddd;
    padding: 10px;
    background: #fff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
  }

  .user-table td {
    position: relative;
   
    text-align: left;
    border: none;
    border-bottom: 1px solid #eee;
  }

  .user-table td::before {
    position: absolute;
    top: 12px;
    left: 12px;
    width: 45%;
    padding-right: 10px;
    white-space: nowrap;
    font-weight: bold;
    color: #444;
    content: attr(data-label);
  }

  .user-table td:last-child {
    border-bottom: none;
  }
}

</style>
  