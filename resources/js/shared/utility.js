
function getTimeDuration(from, to) {
    var splitted1 = from.split(":");
    var splitted2 = to.split(":");

    if (splitted1.length == 2) {
        splitted1[0] = splitted1[0].padStart(2, '0');
    }

    if (splitted2.length == 2) {
        splitted2[0] = splitted2[0].padStart(2, '0');
    }

    if (parseInt(splitted1[0]) > parseInt(splitted2[0])) {
        splitted2[0] = parseInt(splitted2[0]) + 12;
    }


    var time1 = splitted1[0] + ':' + splitted1[1];
    var time2 = splitted2[0] + ':' + splitted2[1];

    var startTime = moment(time1, "HH:mm")
    var end = moment(time2, "HH:mm")

    if (startTime > end) {
        return moment.duration(0, 'seconds');
    }

    return moment.duration(end.diff(startTime));
}
const ontotalhours = (obj) => {

    var duration = getTimeDuration(obj.fn_from, obj.fn_to)
    var duration2 = getTimeDuration(obj.an_from, obj.an_to)

    var duration = duration.add(duration2);

    var res = duration.hours() + '.' + duration.minutes().toString().padStart(2, 0);

    if (!res.includes("NaN") && !res.includes("-")) //no negative time diff when time is like 9:3
        obj.total_hours = res;
    else
        obj.total_hours = '';

};

const sumDurations = (obje) => {
    let tot = moment.duration(0, 'seconds');


    obje.forEach((obj) => {
        //        console.log(obj.total_hours)
        if (obj.total_hours) {
            var splitted = obj.total_hours.toString().split(".");
            //   console.log(splitted)
            if (splitted.length == 2) {
                tot.add(moment.duration(parseInt(splitted[0]), 'hours'));
                tot.add(moment.duration(parseInt(splitted[1]), 'minutes'));
            } else {
                tot.add(moment.duration(parseInt(splitted[0]), 'hours'));

            }
        } else {
            //console.log(obj.total_hours.value)
        }
    })

    var res = tot.asHours().toString().split(".")[0] + '.' + tot.minutes().toString().padStart(2, 0);

    if (!res.includes("NaN") && !res.includes("-")) //no negative time diff when time is like 9:3
        return res;
    else
        return '';

};

export { getTimeDuration, ontotalhours, sumDurations };