<template>
    <div>
        <div class="container ">
            <div class="row mt-5  py-3 bg-light shadow">
                <div class="row mt-5">
                    <h1 class="text-center text-primary">phone numbers</h1><br/>
                </div>
                <div class="row py-3 text-center">
                    <div class="col-md-6">
                        <select  class="form-select" aria-label="Default select example" v-model="country"   @change="changeSelection">
                            <option :value="null">All Countries</option>
                            <option :value="item.country" v-for="item in countries">
                                {{ item.country }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <select  class="form-select" aria-label="Default select example" v-model="state"  @change="changeSelection">
                            <option :value="null">All Phone Numbers</option>
                            <option :value="true"> Valid Phone Numbers  </option>
                            <option :value="false"> Not Valid Phone Numbers  </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 ">
                        <table class="table  table-striped table-bordered text-center  text-capitalize ">
                        <thead>
                        <tr>
                            <th>Country</th>
                            <th>state</th>
                            <th>Country Code</th>
                            <th>phone num</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr   v-for="phoneNumber in phoneNumbers">
                            <td>{{ phoneNumber.country }}</td>
                            <td>{{ phoneNumber.state?"OK":"NOK" }}</td>
                            <td>{{ phoneNumber.code }}</td>
                            <td>{{ phoneNumber.phoneNumber }}</td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="row" >.
                    <div class="col-7"></div>
                    <div class="col-2">
                        <button class="btn btn-primary text-light px-4" @click="onclickPrevPage()" :disabled="!Boolean(this.prevPageUrl)">Previous</button>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary text-light px-5" @click="onclickNextPage()" :disabled="!Boolean(this.nextPageUrl)">Next</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AllPhoneNumbers",
        data() {
            return {
                countries: [],
                phoneNumbers: [],
                requestErrors: [],
                country: null,
                state: null,
                nextPageUrl:null,
                prevPageUrl:null,
                url:'/',
                baseURL:null
            }
        },
        created() {
                const publicEnvVar = import.meta.env.VITE_BASE_URL;
                this.baseURL = publicEnvVar
                this.getCountries();
                this.getPhoneNumbers();
        },methods: {
            getCountries: function()
            {
              window.axios
                    .get(this.baseURL+'/countries')
                    .then(response => {
                        this.countries = response.data;
                    });
            },
            getPhoneNumbers: function()
            {
                window.axios.post(this.baseURL+'/filter'+this.url, {
                    country: this.country,
                    state: this.state,
                }).then(response => {
                    this.phoneNumbers = response.data.data;
                    this.nextPageUrl = response.data.nextPageUrl;
                    this.prevPageUrl = response.data.prevPageUrl;
                }).catch(error => {
                        if (error.response.status === 422) {
                            this.requestErrors = error.response.data.errors;
                            console.log(this.requestErrors)
                        } else {
                            console.log(error.response.data.message)
                        }
                    })
                    .finally(() => {
                         console.log('final');
                    })
            },
            onclickNextPage: function()
            {
                this.url = this.nextPageUrl
                this.getPhoneNumbers()
            },
            onclickPrevPage: function()
            {
                this.url = this.prevPageUrl
                this.getPhoneNumbers()
            },
            changeSelection: function()
            {
                this.url = '/';
                this.getPhoneNumbers()
            }
        }
    }
</script>
