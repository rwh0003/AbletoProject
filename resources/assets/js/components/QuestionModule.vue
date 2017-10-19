<template>
    <div id="QuestionModule">
        <div class="panel panel-info">
            <div class="panel-heading">
                {{ questionTitle }}
            </div>

            <highcharts :options="chartOptions" ref="highcharts" v-if="hasAnswers"></highcharts>

            <ul class="list-group">
                <li class="list-group-item" v-for="(entry, index) in entries" v-if="hasAnswers">
                    <span>{{ entry.answer.text }}</span>

                    <div class="pull-right">
                        {{ entry.formatted_date }}
                    </div>
                </li>
            </ul>

            <div class="panel-body text-center" v-if="isLoading">
                <span class="glyphicon glyphicon-refresh large" aria-hidden="true"></span>
            </div>

            <div class="panel-body" v-if="!hasAnswers">
                No answers reported yet.
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                questionTitle: "",
                answers: [],
                entries: [],
                questionId: this.questionid,
                chartOptions: {},
                hasAnswers: true,
                isLoading: true
            };
        },

        props: ['userid', 'questionid'],

        created() {
            this.getQuestionData();
            this.getEntries();
        },

        methods: {
            getQuestionData() {
                // Scope questionnaire for use inside axios call
                var _this = this;

                // Retrieve question data and populate question title and answer array
                axios.get('/api/question/' + this.questionid)
                     .then(function(res) {
                        _this.questionTitle = res.data.text;
                        _this.answers = res.data.answers;
                     })
                     .catch(function(err) {
                        console.error(err);
                     });
            },

            getEntries() {
                // Scope questionnaire for use inside axios call
                var _this = this;

                // Retrieve entries based on question id and user id and populate entries array
                axios.get('/api/entries/' + this.questionid + '?user_id=' + this.userid)
                     .then(function(res) {
                        _this.isLoading = false;

                        if (res.data.length) {
                            _this.hasAnswers = true;
                            _this.entries = res.data;

                            // Initialize chart with data
                            _this.initChart();
                        } else {
                            _this.hasAnswers = false;
                        }
                     })
                     .catch(function(err) {
                        console.error(err);
                     });
            },

            initChart() {
                var categories = [];
                var counts = [];
                var data = [];

                // Categories array
                this.answers.forEach(function(el, i, arr) {
                    categories.push(el.text);
                });

                // Calculate counts for each answer
                this.entries.forEach(function(el, i, arr) {
                    // Chart initializes indices starting at 0, so subtract 1
                    // Answers are based on scale of 0-3, so modulo id to get correct index
                    var index = (el.answer_id - 1) % 4;

                    // Index represents answer, so only initialize if there is a count
                    counts[index] = counts[index] == null ? 1 : (counts[index] + 1);
                });

                // Create data array based on answer counts
                // Data array is structured as [[answerId, count], ...]
                for (var i = 0; i < 4; i++) {
                    // If undefined, count is 0
                    data.push([i, typeof counts[i] === 'undefined' ? 0 : counts[i]]);
                }

                // Populate chart options, which propogate to <highcharts> component
                this.chartOptions = {
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: null
                    },
                    tooltip: {
                        enabled: false
                    },
                    xAxis: {
                        categories: categories
                    },
                    yAxis: {
                        title: {
                            text: 'Number reported'
                        },
                        tickInterval: 1
                    },
                    series: [{
                        data: data,
                        showInLegend: false
                    }]
                };
            }
        }
    }
</script>
