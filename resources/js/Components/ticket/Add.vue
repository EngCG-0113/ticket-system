<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form>
                  <div class="mb-3">
                    <label for="headline" class="form-label">Issue Headline</label>
                    <input type="text" class="form-control" id="headline" v-model="ticket.issue_headline" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="description" class="form-label">Issue Description</label>
                    <textarea class="form-control" id="description" v-model="ticket.issue_description"/>
                  </div>
                  <div class="mb-3">
                    <label for="requested_by" class="form-label">Requested By</label>
                    <input type="text" class="form-control" id="requested_by" v-model="ticket.requested_by">
                  </div>
                  <div class="mb-3">
                    <label for="requested_date" class="form-label">Requested Date</label>
                    <vue-date-picker  v-model="ticket.requested_date" name="requested_date"/>
                  </div>

                  <button @click="submit()" type="button" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ticket: {
                    'issue_headline':'',
                    'issue_description':'',
                    'requested_by':'',
                    'requested_date': new Date(),
                    'status':'open',
                },
            }
        },
        mounted() {
        },
        methods:{
            submit(){
                axios.post('/api/v1/tickets',this.ticket)
                .then(({data}) => {
                    window.location.href = '/tickets';
                });
            },
        },
    }
</script>
