<template>
    <div>
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
                            <h3>Update Employees</h3> 
                        </div>
                        <router-link :to="{name: 'EmployeesIndex'}" class="btn btn-info float-right">Back</router-link>
                    </div>
                </div>
                <div class="card-body">
                    <form @submit.prevent="updateEmployee">
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                <input id="firtname" v-model="form.firstname" type="text" class="form-control" name="firstname" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="middlename" class="col-md-4 col-form-label text-md-right">Middle Name</label>

                            <div class="col-md-6">
                                <input id="middlename" v-model="form.middlename" type="text" class="form-control" name="middlename" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">Last Name</label>

                            <div class="col-md-6">
                                <input id="lastname" v-model="form.lastname" type="text" class="form-control" name="lastname" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                            <div class="col-md-6">
                                <input id="address" v-model="form.address" type="text" class="form-control" name="address" required>
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="county" class="col-md-4 col-form-label text-md-right">Country</label>

                            <div class="col-md-6">
                                <select v-model="form.country_id" @change="getStates()" name="country" class="form-control">
                                    <option v-for="country in countries" :key="country.id" :value="country.id"
                                    >{{ country.name }}</option>
                                </select>                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">State</label>

                            <div class="col-md-6">
                                <select v-model="form.state_id" @change="getCities()" name="state" class="form-control">
                                    <option v-for="state in states" :key="state.id" :value="state.id"
                                    >{{ state.name }}</option>
                                </select>                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">City</label>

                            <div class="col-md-6">
                                <select v-model="form.city_id" name="city" class="form-control">
                                    <option v-for="city in cities" :key="city.id" :value="city.id"
                                    >{{ city.name }}</option>
                                </select>                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="department" class="col-md-4 col-form-label text-md-right">Department</label>

                            <div class="col-md-6">
                                <select v-model="form.department_id" name="department" class="form-control">
                                    <option v-for="department in departments" :key="department.id" :value="department.id"
                                    >{{ department.name }}</option>
                                </select>                              
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-right">Zip code</label>

                            <div class="col-md-6">
                                <input id="zip_code" v-model="form.zip_code" type="text" class="form-control" name="zip_code" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-right">Birth Date</label>

                            <div class="col-md-6">
                                <datepicker input-class="form-control" v-model="form.birthdate"></datepicker>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_hired" class="col-md-4 col-form-label text-md-right">Date Hired</label>

                            <div class="col-md-6">
                                <datepicker input-class="form-control" v-model="form.date_hired"></datepicker>
                            </div>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import moment from 'moment';
export default {
    components: {
        Datepicker
    },
    data() {
        return {
            countries: [],
            states: [],
            cities: [],
            departments: [],
            form: {
                firstname: '',
                middlename: '',
                lastname: '',
                address: '',
                country_id: '',
                state_id: '',
                city_id: '',
                department_id: '',
                zip_code: '',
                birthdate: null,
                date_hired: null
            },
            showMessage: false,
            message: ''
        }
    },
    created() {
        this.getCountries();
        this.getDepartments();
        this.getEmployee();
    },
    methods: {
        getEmployee() {
            axios.get('/api/employees/'+ this.$route.params.id)
            .then(res => {
                this.form = res.data.data
                this.getStates();
                this.getCities();
            })
            .catch(error => {
                console.log(error);
            })
        },
        getCountries(){
            axios.get('/api/employees/countries')
            .then(res => {
                this.countries = res.data
            })
            .catch(error => {
                console.log(error);
            })
        },
        getStates() {
            axios.get('/api/employees/'+ this.form.country_id + '/states')
            .then(res => {
                this.states = res.data
            })
            .catch(error => {
                console.log(error);
            })
        },
        getCities() {
            axios.get('/api/employees/'+ this.form.state_id + '/cities')
            .then(res => {
                this.cities = res.data
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
        updateEmployee() {
            axios.put('/api/employees/' + this.$route.params.id, {
                firstname: this.form.firstname,
                middlename: this.form.middlename,
                lastname: this.form.lastname,
                address: this.form.address,
                country_id: this.form.country_id,
                state_id: this.form.state_id,
                city_id: this.form.city_id,
                department_id: this.form.department_id,
                zip_code: this.form.zip_code,
                birthdate: this.format_date(this.form.birthdate),
                date_hired: this.format_date(this.form.date_hired)
            })
            .then(res => {
                this.showMessage = true;
                this.message = res.data
                this.$router.push({name: 'EmployeesIndex'})
            });         
        },
        format_date(value) {
            if (value) {
                return moment(String(value)).format('YYYYMMDD')
            }
        }
    }
}
</script>

<style>

</style>