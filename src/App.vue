<template>
  <div class="feed">
    <h2 class="form-title">Employee Form</h2>
    <form class="form" @submit.prevent="submitForm">
      <div class="form-group">
        <label for="first-name">First Name:</label>
        <input type="text" id="first-name" v-model="firstName">
      </div>
      <div class="form-group">
        <label for="last-name">Last Name:</label>
        <input type="text" id="last-name" v-model="lastName">
      </div>
      <div class="form-group">
        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" v-model="dob">
      </div>
      <div class="form-group">
        <label for="job">Job:</label>
        <input type="text" id="job" v-model="job">
      </div>
      <div class="form-group">
        <label for="salary">Salary:</label>
        <input type="number" id="salary" v-model="salary">
      </div>
      <div>
        <button class="btn" @click.prevent="submitForm">Submit</button>
      </div>
    </form>
    <div v-if="showDialog" class="dialog-overlay">
      <div class="dialog-box">
        <h3>Employee Information</h3>
        <p><strong>First Name:</strong> {{ firstName }}</p>
        <p><strong>Last Name:</strong> {{ lastName }}</p>
        <p><strong>Date of Birth:</strong> {{ dob }}</p>
        <p><strong>Job:</strong> {{ job }}</p>
        <p><strong>Salary:</strong> {{ salary }}</p>
        <button class="btn" @click="closeDialog">Close</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      firstName: '',
      lastName: '',
      dob: '',
      job: '',
      salary: '',
      showDialog: false
    }
  },
  methods: {
    submitForm() {
      console.log("Form submitted!");

      const formData = new FormData();
      formData.append('first_name', this.firstName);
      formData.append('last_name', this.lastName);
      formData.append('dob', this.dob);
      formData.append('job', this.job);
      formData.append('salary', this.salary);

      axios.post('http://localhost/Php%20projekte/employee/src/add_employee.php', formData)
        .then(response => {
          console.log(response.data);
          this.showDialog = true;
        })
        .catch(error => {
          console.log(error);
        });
    },
    closeDialog() {
      this.showDialog = false;
    }
  }
}
</script>

<style>
.form-title {
  margin-bottom: 1rem;
  text-align: center;
}

.feed {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.form {
  background-color: #f5f5f5;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  width: 500px;
  max-width: 100%;
}

.form-group {
  margin-bottom: 10px;
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="date"],
input[type="number"] {
  border: none;
  padding: 10px;
  border-radius: 5px;
  width: 100%;
  box-sizing: border-box;
}

button.btn {
  background-color: lightgreen;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  display: block;
}

.button-container {
    display: flex;
    justify-content: space-between;
  }

  .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    display: block;
    margin-top: 10px;
  }

  .submit-btn {
    background-color: lightgreen;
    color: white;
  }

  .cancel-btn {
    background-color: tomato;
    color: white;
  }
</style>

 
