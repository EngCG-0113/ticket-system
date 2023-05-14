<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-mt-8">
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
                            <td>{{ticket.status}}</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tickets: [],
                page: 1,
                search: "",
            }
        },
        mounted() {
            this.getList();
        },
        methods:{
            getList(){
                axios.get('/api/v1/tickets')
                .then(({data}) => {
                    console.log(data);
                    let tickets = data.data;
                    this.tickets = tickets;
                });
            },
        }
    }
</script>
