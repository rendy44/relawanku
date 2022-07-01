import PropTypes from 'prop-types';
import DatePicker from "react-datepicker";
import {MultiSelect} from "react-multi-select-component";
import ReactLoading from 'react-loading';

const {useState, useEffect} = wp.element

const Input = props => {
    const [value, setValue] = useState(props.value)
    const usedType = props.type ?? 'text'
    const usedName = props.name ?? 'name'
    const usedLabel = props.label ?? 'Name'
    const onChange = e => {
        setValue(e.target.value)
    }
    useEffect(() => {
        // console.log(value)
    }, [value])

    const usedPlaceholder = props.placeholder ?? ''
    return <>
        <label>{usedLabel}
            <input type={usedType}
                   name={usedName}
                   value={value}
                   placeholder={usedPlaceholder}
                   onChange={onChange}/>
        </label>
    </>
}
Input.propTypes = {
    name: PropTypes.string.isRequired,
    type: PropTypes.string,
    label: PropTypes.string,
    placeholder: PropTypes.string
}

const Select = props => {
    const [value, setValue] = useState(props.value)
    const usedName = props.name ?? 'name'
    const usedLabel = props.label ?? 'Name'
    const onChange = e => {
        setValue(e.target.value)
    }
    let usedOptions = [];
    props.options.map(opt => {
        usedOptions.push(<option>{opt}</option>)
    })
    useEffect(() => {
        // console.log(value)
    }, [value])
    return <>
        <label>
            {usedLabel}
            <select name={usedName} onChange={onChange}>
                {usedOptions}
            </select>
        </label>
    </>
}
Select.propTypes = {
    name: PropTypes.string.isRequired,
    options: PropTypes.array.isRequired,
    label: PropTypes.string,
}

const DateP = props => {
    const [value, setValue] = useState(new Date())
    const usedLabel = props.label ?? 'Name'

    return <>
        <label>
            {usedLabel}
            <DatePicker selected={value} onChange={(date) => setValue(date)}/>
        </label>
    </>
}
DateP.propTypes = {
    label: PropTypes.string
}

const Button = props => {
    const usedLabel = props.label ?? 'Button'
    const onClick = e => {
        props.callback()
    }
    return <button className={`button button-${props.type}`} onClick={onClick}>{usedLabel}</button>
}
Button.propTypes = {
    label: PropTypes.string,
    type: PropTypes.oneOf(['success', 'warning', 'danger', 'primary', 'secondary']).isRequired,
    callback: PropTypes.func.isRequired
}

const SelectMultiple = props => {
    const [value, setValue] = useState([])
    const usedLabel = props.label ?? 'Name'
    const usedOptions = props.options ?? []
    // const options = [
    //     {label: "Grapes 🍇", value: "grapes"},
    //     {label: "Mango 🥭", value: "mango"},
    //     {label: "Strawberry 🍓", value: "strawberry", disabled: true},
    // ]
    return <>
        <label>
            {usedLabel}
            <MultiSelect
                options={usedOptions}
                value={value}
                onChange={setValue}
                labelledBy="Select"
            />
        </label>
    </>
}
SelectMultiple.propTypes = {
    label: PropTypes.string,
    options: PropTypes.array.isRequired
}

const Loading = props => {
    return <div className={'frow gutters'}>
        <div className={'col-sm-1-1'}>
            <div className={'text-center'}>
                <ReactLoading type={'cylon'} color={'#737'} height={64} width={64}/>
            </div>
        </div>
    </div>
}

export {Input, Select, DateP, Button, SelectMultiple, Loading};