<template>
    <div>
        <h1>Employees</h1>

        <div class="col-md-8">
            <div class="card">
                <div v-if="showMessage">
                        <div class="alert alert-success">
                           {{ message }}
                        </div>
                   
                </div>
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <form >
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                    <input type="search" v-model.lazy="search" name="search" class="form-control mb-2" id="inlineFormInput" placeholder="Search">
                                    </div>
                                    
                                    <div class="col-auto">
                                    <button type="submit" class="btn btn-primary mb-2">Search</button>
                                    </div>

                                    <div class="col-auto">
                                        <select v-model="selectedDepartment" name="department" class="form-control">
                                            <option v-for="department in departments" :key="department.id" :value="department.id"
                                            >{{ department.name }}</option>
                                        </select>   
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col">
                            <router-link :to="{name: 'EmployeesCreate'}" class="btn btn-primary float-right">Create</router-link>
                        </div>
                    </div>        
                    
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Department</th>
                            <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                       
                        <tr v-for="employee in employees" :key="employee.id">
                        <th scope="row">{{ employee.id }}</th>
                        <td>{{ employee.lastname }}</td>
                        <td>{{ employee.firstname }}</td>
                        <td>{{ employee.address }}</td>
                        <td>{{ employee.department.name }}</td>
                        <td>                           
                            <router-link :to="{name: 'EmployeesEdit', params: {id: employee.id}}" class="btn btn-secondary"><i class="fas fa-fw fa-edit"></i></router-link>
                            <a href="#" class="btn btn-danger" @click="deleteEmployee(employee.id)"><i class="fas fa-fw fa-trash"></i></a>
                        </td>
                        </tr>
                      
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            employees: [],
            showMessage: false,
            message: '',
            search: null,
            selectedDepartment: null,
            departments: []
        }
    },
    watch: {
        search() {
            this.getEmployees();
        },
        selectedDepartment() {
            this.getEmployees();
        }
    },
    created() {
        this.getEmployees();
        this.getDepartments();
    },
    methods: {
        getEmployees() {
            axios.get('/api/employees', {
                params: {
                    search: this.search,
                    department_id: this.selectedDepartment
                }
            })
            .then(res => {
                this.employees = res.data.data
            })
            .catch(error => {
                console.log(error);
            })
        },
        getDepartments() {
            axios.get('/api/employees/departments')
            .then(res => {
                this.departments = res.data
            })
            .catch(error => {
                console.log(error);
            })
        },
        deleteEmployee(id) {
            axios.delete('/api/employees/'+ id)
            .then(res => {
                this.showMessage = true;
                this.message = res.data
                this.getEmployees();
            })
        }
    }
};

</script>
