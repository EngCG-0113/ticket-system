<template>
    <div class="container-fluid">
        <div v-for="(pop) in popout" class="alert alert-primary" role="alert">
          {{pop}}
        </div>
        <div class="row justify-content-center">
            <div class="container-fluid mt-3">
                <div class="row justify-content-end">
                    <div class="col input-group">
                      <input type="text" class="form-control" placeholder="Search"  aria-describedby="button-addon2" v-model="search">
                      <button @click="getList" class="btn btn-outline-secondary" type="button" id="button-addon2">Search</button>
                    </div>
                    <div class="col">
                      <a href="/tickets/add" class="btn btn-outline-primary" type="button">Add Ticket</a>
                    </div>
                </div>
            </div>
            <div class="mt-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Headline</th>
                            <th>Requested By</th>
                            <th>Requested Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(ticket) in tickets">
                            <td scope="row"><a style="color:blue" :href="`/tickets/`+ticket.id" >{{ticket.issue_headline}}</a></td>
                            <td>{{ticket.requested_by}}</td>
                            <td>{{ticket.requested_date}}</td>
                            <td><span class="badge" :class="{'bg-success': ticket.status == `open`, 'bg-danger': ticket.status == `closed`}">{{ticket.status}}</span></td>
                            <td><button @click="changeStatus(ticket.id)" class="btn btn-outline-secondary" type="button">{{ticket.status == `closed` ? 'Re-Open Ticket' : 'Closed Ticket'}}</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <paginator
                :pagination="paginateData"
                @page-clicked="swapPage"
            />
        </div>
    </div>
</template>

<script>
    import Paginator from "../Paginator.vue";
    export default {
        data() {
            return {
                tickets: [],
                search: "",
                page: 1,
                paginateData: {},
                popout: [],
            }
        },
        mounted() {
            this.getList();
        },
        methods:{
            getList(page = 1){
                let data = {
                    web: 1,
                    page: page,
                    search: this.search
                }

                axios.get('/api/v1/tickets',{params:data})
                .then(({data}) => {
                    let tickets = data.data;
                    this.tickets = tickets;
                    this.paginateData = data.meta;
                });
            },
            swapPage(page){
                this.page = page;
                this.getList(page);
            },
            changeStatus(id){
                axios.put('/api/v1/tickets/'+id)
                .then(({data}) => {
                    if(!data.error){
                        this.popout.push(data.issue_headline+" has been "+data.status);
                        this.getList(this.page);
                        setTimeout(() => {
                            this.popout.shift();
                        }, 5000)
                    }
                });
            },
        },
        components:{
            Paginator,
        }
    }
</script>
