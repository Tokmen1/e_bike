<template>
  <div class="wrapper">
    <div class="animated fadeIn">
      <b-card>
        <b-row>
          <b-col>
            <h4>Darbinieku elektriskie velosipēdi</h4>
          </b-col>
          <b-col md="auto">
            <b-button-group>
                <b-button v-if="!contentIsLoading" class="mb-3" variant="primary" 
                :to="{ name: 'EmployeeEbikeCreate' }"
                >
                  Pievienot jaunu
                </b-button>
            </b-button-group>
          </b-col>
          <b-col md="auto">
            <b-button-group>
            <b-button v-if="!isHidden" variant="primary" @click="printer()" >
                  Printēt
                </b-button>
            </b-button-group>
          </b-col>
        </b-row>
        <b-row >
          <b-col>
            <b-form-group>
              <b-input-group>
                <label>Datums no: </label>
                <b-form-input v-model="filters.search_date_from" type="date" debounce="700"></b-form-input>
                <label>Datums līdz: </label>
                <b-form-input v-model="filters.search_date_to" type="date" debounce="700"></b-form-input>
              </b-input-group>
            </b-form-group>
          </b-col>
        </b-row>
        <div v-if="contentIsLoading" class="text-center">
          <b-spinner type="grow" variant="primary"/>
        </div>
        <div v-else>
          <b-row>
            <b-col>
              <div v-if="!tableItems.length">
                <div v-if="filters.search">Netika atrasti dati ar vārdu <b>"{{ filters.search }}"</b>!</div> 
                <div v-else v-b-popover.hover.bottom="'Spied pogu \'\'Pievienot jaunus sējas datus\'\''">
                  Tabulā nav ievadīti dati!
                </div>
              </div>
              <b-table v-else class="table-sm text-center" responsive bordered
                  :no-local-sorting=true
                  :fields="tableFields"
                  :items="tableItems"
                  >
                <template v-slot:cell(options)="row">
                  <div class="flex-container options-center">
                  <router-link :to="{ name: 'EmployeeEbikeUpdate', params:{ id: row.item.id }}">
                    <a><i class="mx-1 fa fa-edit fa-lg"/></a>
                    <b-btn variant="primary" class="mx-1">Rediģēt</b-btn>
                  </router-link>
                  <b-btn href="#" @click="deleteData(row.item.id)" variant="danger" class="mx-1">Dzēst</b-btn>
                  </div>
                </template>
              </b-table>
            </b-col>
          </b-row>
        </div>
      </b-card>
    </div>
  </div>
</template>

<script>
import Services from '@/services/index';
import AlertMixin from '@/mixins/AlertMixin';
export default {
  mounted() {
    this.getData();
  },
  props: ['page', 'id'],
  data() {
    return {
      list: {
        data: {},
      },
      tableFields: [
        { key: 'first_name', label: 'Vārds' },
        { key: 'last_name', label: 'Uzvārds' },
        { key: 'email', label: 'E-pasts' },
        { key: 'brand', label: 'Elektroritenis' },
        { key: 'odometer', label: 'Odometrs (km)' },
        { key: 'date_from', label: 'Sākuma datums' },
        { key: 'date_to', label: 'Noslēguma datums' },
        { key: 'options', label: 'Iespējas' },
      ],
      filters: {
        search: '',
        search_date_from: '',
        search_date_to: ''
      },
      isHidden: false,
      timer: 0,
    };
  },
  computed: {
    tableItems() {
      return this.list.data.data || [];
    },
    contentIsLoading() {
      return false;
    },
    params() {
      return {
        ...this.filters,
        page: this.page,
      };
    },
  },
  watch: {
    page: 'getData',
    filters: { deep: true, handler: 'getData' },
  },
  methods: {
    printer(){
      this.isHidden = true;
      setTimeout(function(){ window.print(); }, 100)
      setTimeout(function(){this.isHidden = false; }, 5000);
    },
    deleteData($my_id) {
      if (confirm('Vai tiešām vēlaties izdzēst?')){
        Services.employeeEbike.delete($my_id).then(() => {
          this.getData();
          this.alertSuccess({text: 'Atlasītais ierakst ir veiksmīgi dzēsts!', title: 'Veiksmīgi dzēsts'});
        }).catch(err => console.log(err));
      }
    },
    getData() {
      Services.employeeEbike.list(this.params).then((data) => {
        this.list.data = data.data;
      });
    },
    onPageChange(page) {
      page = page || this.page;
      if (page !== this.page) this.$router.push({ name: 'EmployeeEbike', params: { page } });
    },
  },
  mixins: [AlertMixin]
};
</script>