<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">tEST Component</div>
                     
                    <div class="card-body">
                        
                        {{this.$data}}
                        {{attributeC}}
                        {{this.$cookie.set('test', 'Mervin', 1)}}
                        {{this.$cookie.get('test')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        
        data() {
            return {
                name:  'testing',
                name1:  'testing'
                
                
            }
        },
        mounted() {
            
            console.log('Component mounted.')
        }
    }
</script>
