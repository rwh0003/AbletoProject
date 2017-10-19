<template>
    <div id="Questionnaire">
        <div class="row">
            <div class="col-xs-12">
                <div class="pull-right form-group">
                    Entry for {{ displayDate }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Questionnaire

                        <div class="pull-right">
                            <span class="glyphicon glyphicon-refresh" aria-hidden="true" v-if="isLoading"></span>
                            <button type="button" class="btn btn-default btn-xs" @click="setDate('prev')">Previous day</button>
                            <button type="button" class="btn btn-default btn-xs" @click="setDate('next')">Next day</button>
                        </div>
                    </div>

                    <ul class="list-group">
                        <li class="list-group-item" v-for="(question, index) in questions">
                            <div class="form-group">
                                <label>{{ question.text }}</label>

                                <div class="radio" v-for="(answer, index) in question.answers">
                                    <label>
                                        <input type="radio" 
                                               :name="'question_' + question.id" 
                                               :value="answer.id"
                                               :checked="answers[question.id] === answer.id"
                                               v-model="answers[question.id]"
                                               @click="setAnswer(question.id, answer.id)">
                                        {{ answer.text }}
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary" @click="saveEntries()">Save Entry</button>

                        <span class="text-success" v-if="saved">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true" v-if="saved"></span>
                            Saved!
                        </span>
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
                questions: [],
                answers: [],
                entryDate: null,
                displayDate: null,
                isLoading: true,
                saved: false
            };
        },

        props: ['userid'],

        created() {
            this.setDate();
        },

        methods: {
            setDate(dateDir = null) {
                this.isLoading = true;

                let date = new Date();

                // If dateDir is not null, set date based on parameter given
                if (dateDir == "next") {

                    // Next day
                    date = this.entryDate;
                    date.setDate(date.getDate() + 1);

                } else if (dateDir == "prev") {

                    //Previous day
                    date = this.entryDate;
                    date.setDate(date.getDate() - 1);
                }

                // Set date object
                this.entryDate = date;

                // Options for date output format
                var options = { 
                    weekday: 'long', 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric' 
                };

                // Set display date string
                this.displayDate = date.toLocaleDateString("en-US", options);

                // Reload answers
                this.getEntries();
            },

            getEntries() {
                // Scope questionnaire for use inside axios call
                var _this = this;

                // Reset answers array
                _this.answers = [];

                // Retrieve entries based on user id and date
                axios.get('/api/entries/?user_id=' + this.userid + "&date=" + this.displayDate)
                     .then(function(res) {

                        // Populate answer array with new answers, if any
                        res.data.forEach(function(el, i, arr) {
                            _this.setAnswer(el.question_id, el.answer_id);
                        });

                        // Reset questions with loaded entries
                        _this.getQuestions();
                     })
                     .catch(function(err) {
                        console.error(err);
                     });
            },

            getQuestions() {
                // Scope questionnaire for use inside axios call
                var _this = this;

                // Retrieve questions and answer data
                axios.get('/api/questions')
                     .then(function(res) {
                        _this.questions = res.data;
                     })
                     .catch(function(err) {
                        console.error(err);
                     });

                this.isLoading = false;
            },

            saveEntries() {
                // Scope questionnaire for use inside axios call
                var _this = this;

                this.isLoading = true;

                // Format data for save
                var data = {
                    'answers': this.answers,
                    'date': this.displayDate
                };

                // Save entry
                axios.post('/questionnaire/save', data)
                     .then(function(res) {
                        console.log(res);
                        _this.saved = true;

                        setTimeout(function(){
                            _this.saved = false;
                        }, 2000);
                     })
                     .catch(function(err) {
                        console.error(err);
                     });

                this.isLoading = false;
            },

            setAnswer(questionId, answerId) {
                this.answers[questionId] = answerId;
            }
        }
    }
</script>
