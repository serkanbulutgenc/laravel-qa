export default {
    modify(user,model){
        //console.log(model);
        return user.id === model.user.id
        //return true;
    },
    accept(user, answer){
        //console.log(user.id);
        //return user.id === answer.question.user.id
        return user.id === answer.question.user.id;
        //return true;
    },
    deleteQuestion(user, question){
        return user.id === question.user.id && question.answers_count < 1
    }
}
