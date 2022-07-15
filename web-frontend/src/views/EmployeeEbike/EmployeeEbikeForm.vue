<template>
  <div class="animated fadeIn">
    <b-card>
      <div slot="header">
        <b-row>
          <b-col cols="6">
            <span v-if="isUpdateForm">Rediģēt datus</span>
            <span v-else>Izveidot datus</span>
          </b-col>
        </b-row>
      </div>
      <div v-if="spinners.contentIsLoading" class="text-center">
        <b-spinner type="grow" variant="primary"/>
      </div>
      <div v-else>
        <template>
          <b-form-group :invalid-feedback="fErr(entity.employee_id, 'Darbinieks:')">
            <label>Darbinieks:</label>
            <b-form-select v-model="entity.employee_id" :options="options" 
                :class="{ 'is-invalid' : fErr(entity.employee_id, 'Darbinieks:') }"
                >
              <option v-for="i in employee.data.data.length" :key="i" v-bind:value="employee.data.data[i-1].id">
                {{ employee.data.data[i-1].first_name +" "
                + employee.data.data[i-1].last_name +" "
                + employee.data.data[i-1].email }}
              </option>
            </b-form-select>
          </b-form-group>
        </template>

        <template>
          <b-form-group :invalid-feedback="fErr(entity.e_bike_id, 'Elektroritenis')">
            <label>Elektroritenis:</label>
            <b-form-select v-model="entity.e_bike_id" :options="options"
                :class="{ 'is-invalid' : fErr(entity.e_bike_id, 'Elektroritenis') }"
                >
              <option v-for="i in ebike.data.data.length" :key="i" v-bind:value="ebike.data.data[i-1].id">
                {{ebike.data.data[i-1].brand +" "+ ebike.data.data[i-1].odometer +"km"}}
              </option>
            </b-form-select>
          </b-form-group>
        </template>
        
        <b-form-group :invalid-feedback="fErr(entity.date_from, 'Sākuma datums') || dateErr(entity.date_from, entity.date_to)">
          <label>Sākuma datums</label>
          <b-form-input type="date" placeholder="Sākuma datums"
            :class="{ 'is-invalid' : fErr(entity.date_from, 'Sākuma datums') || dateErr(entity.date_from, entity.date_to) }"
            debounce="250"
            v-model="entity.date_from"/>
        </b-form-group>

        <b-form-group :invalid-feedback="dateErr(entity.date_from, entity.date_to)">
          <label>Noslēguma datums</label>
          <b-form-input type="date" placeholder="Noslēguma datums"
            :class="{ 'is-invalid' : dateErr(entity.date_from, entity.date_to) }"
            debounce="250"
            v-model="entity.date_to"/>
        </b-form-group>
      </div>
      <div slot="footer">
        <b-button :to="{ name: 'EmployeeEbike', params:{ page: 1 } }" type="reset" variant="primary" >
          Atcelt
        </b-button>
        <b-button type="submit" variant="primary" :disabled="spinners.isSaving" @click="save()" class="ml-5">
          <b-spinner v-if="spinners.isSaving" type="grow" small/>
          Saglabāt
        </b-button>
      </div>
    </b-card>
  </div>
</template>

<script>
import merge from 'lodash.merge';
import Services from '@/services/index';
import ErrorMixin from '@/mixins/ErrorMixin';
import AlertMixin from '@/mixins/AlertMixin';
export default {
  mounted() {
    this.load();
  },
  data() {
    return {
      spinners: {
        contentIsLoading: false,
        isSaving: false,
      },
      entity: this.value,
      errorMsg: this.errors,
      ebike:{
          data:{},
      },
      employee:{
          data:{},
      },
    };
  },
  props: {
    // If id === null, form will be considered create form else update
    id: { type: Number, default: null },
    // if title == false to hide header, pass string to override default title
    title: { type: [String, Boolean], default: undefined },
    // pass errors from parent form if embedded
    errors: { type: Object, default() { return {}; } },
    // value is used both as DEFAULTs placeholder and for v-model
    value: {
      type: Object,
      default() {
        return {
          employee_id: null,
          e_bike_id: null,
          date_from: null,
          date_to: null,
        };
      },
    },
  },
  components: {
  },
  computed: {
    // embedded form will have value passed using v-model
    isEmbedded() { return this.$options.propsData.value !== undefined; },
    isUpdateForm() { return this.id !== null; },
    ebikeId() { return this.entity.ebike_id },
  },
  methods: {
    getForUpdate: Services.employeeEbike.editData,
    getForCreate: Services.employeeEbike.createData,
    pushUpdate: Services.employeeEbike.update,
    pushCreate: Services.employeeEbike.create,
    load() {
      this.spinners.contentIsLoading = true;
      const action = this.isUpdateForm ? this.getForUpdate : this.getForCreate;
      action(this.$route.params.id).then((data) => {
        this.spinners.contentIsLoading = false;
        this.entity = this.isUpdateForm ? data.data.employeeEbike : { ...this.entity, ...data.data.employeeEbike };
      }).catch((data) => {
        this.spinners.contentIsLoading = false;
        this.errorMsg = data.data ? data.data.errors : {};
      });
      Services.ebike.list().then((data) => {
        this.ebike.data = data.data;
      });
      Services.employee.list().then((data) => {
        this.employee.data = data.data;
      });
    },
    save() {
      if (this.entity.employee_id === null) { this.entity.employee_id = ""; }
      if (this.entity.e_bike_id === null) { this.entity.e_bike_id = ""; }
      if (this.entity.date_from === null) { this.entity.date_from = ""; }
      if (this.entity.date_from > this.entity.date_to) { this.entity.date_from = ""; }
      if (this.isEmbedded) return;
      this.spinners.isSaving = true;
      const action = this.isUpdateForm ? this.pushUpdate : this.pushCreate;
      action(this.entity).then((data) => {
        this.spinners.isSaving = false;
        this.alertSuccess();
        setTimeout(() => {
          if (this.isUpdateForm) {
            this.alertSuccess({text: 'Dati rediģēti veiksmīgi!'});
          } else {
            this.alertSuccess({text: 'Dati pivienoti veiksmīgi!'});
          }
        }, 10);
        // this.entity = data.data; // This wont work if entity has nested objects/forms
        merge((this.entity), data.data); // This will not delete keys but will preserve original object
        this.errorMsg = {};
        this.$router.push({ name: 'EmployeeEbike', params: { page: 1 }});
      }).catch(({ errors, message }) => {
        this.spinners.isSaving = false;
        this.errorMsg = errors;
        this.alertError({ text: message });
      });
    },
  },
  mixins: [ErrorMixin, AlertMixin]
};
</script>