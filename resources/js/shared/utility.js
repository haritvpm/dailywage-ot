
function getTimeDuration(from, to) {

    if (!from || !to) {
        return moment.duration(0, 'seconds');

    }
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
    let tot = moment.duration(0, 'seconds');

    var duration = getTimeDuration(obj.fn_from, obj.fn_to)
    var duration2 = getTimeDuration(obj.an_from, obj.an_to)

    if (duration) tot.add(duration);
    if (duration2) tot.add(duration2);

    // var res = tot.hours() + '.' + tot.minutes().toString().padStart(2, 0);
    var res = tot.asHours().toFixed(2).toString();

    if (!res.includes("NaN") && !res.includes("-")) //no negative time diff when time is like 9:3
        obj.total_hours = res;
    else
        obj.total_hours = '';

};

const sumDurations = (obje) => {
    /*
        let tot = moment.duration(0, 'seconds');
        obje.forEach((obj) => {
              if (obj.total_hours) {
                var splitted = obj.total_hours.toString().split(".");
                  if (splitted.length == 2) {
                    tot.add(moment.duration(parseInt(splitted[0]), 'hours'));
                    splitted[1] = splitted[1].padEnd(2, 0) //3 -> 30
                    tot.add(moment.duration(parseInt(), 'minutes'));
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
    */

    let tot = 0;
    obje.forEach((obj) => {
        if (obj.total_hours) {
            tot += parseFloat(obj.total_hours)
        }

    })
    return tot.toString();

};
const sumHoursForm3 = (obj) => {
    let tot = 0;
    obj?.all_ot_hours.forEach((h) => {
        if (h) {
            tot += parseFloat(h)
        }
    })
    let res = tot.toString();;
    if (!res.includes("NaN") && !res.includes("-")) //no negative time diff when time is like 9:3
        obj.total_hours = res;
    else
        obj.total_hours = '';

};

const validateTimes = (obj, check_empty_rows) => {
    var formats = ["h:mm", "HH:mm"];

    let errors = []
    let totalvalidrows = 0;
    obj.forEach((item, index, arr) => {
        if ((item.fn_from ^ item.fn_to) || (item.an_from ^ item.an_to)) {
            //errors.push( 'Please fill row ' +  (index+1) )
        }
        let thisrowhaserror = false;

        if ((item.fn_from || item.fn_to) || (item.an_from || item.an_to)) {

            if (item.fn_from || item.fn_to) {
                if (!moment(item.fn_from, formats, true).isValid() ||
                    !moment(item.fn_to, formats, true).isValid()) {
                    errors.push('Please enter correct morning time in row ' + (index + 1))
                    thisrowhaserror = true;
                }

            }

            if (item.an_from || item.an_to) {
                if (!moment(item.an_from, formats, true).isValid() ||
                    !moment(item.an_to, formats, true).isValid()) {
                    errors.push('Please enter correct evening time in row ' + (index + 1))
                    thisrowhaserror = true;
                }
            }
        } else {
            thisrowhaserror = true; //empty row
        }

        if (!thisrowhaserror) {
            totalvalidrows += 1;
        }

    })

    if (check_empty_rows && totalvalidrows != obj.length) {
        errors.push('Please fill all rows or remove unneeded rows')

    }

    return errors
}

const copyTimes = (obj, col) => {
    for (let i = 1; i < obj.length; i++) {
        if ('am' == col && obj[0]?.fn_from) {
            obj[i].fn_from = obj[0]?.fn_from
            obj[i].fn_to = obj[0]?.fn_to
        } else if (obj[0]?.an_from) {
            obj[i].an_from = obj[0]?.an_from
            obj[i].an_to = obj[0]?.an_to
        }
        ontotalhours(obj[i])
    }

}
export { sumHoursForm3, copyTimes, getTimeDuration, ontotalhours, sumDurations, validateTimes };