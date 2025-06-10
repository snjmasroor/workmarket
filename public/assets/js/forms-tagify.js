/**
 * Tagify
 */

'use strict';

(function () {
  // Basic
  //------------------------------------------------------
  const tagifyBasicEl = document.querySelector('#TagifyBasic');
  const TagifyBasic = new Tagify(tagifyBasicEl);

  // Read only
  //------------------------------------------------------
  const tagifyReadonlyEl = document.querySelector('#TagifyReadonly');
  const TagifyReadonly = new Tagify(tagifyReadonlyEl);

  // Custom list & inline suggestion
  //------------------------------------------------------
  const TagifyCustomInlineSuggestionEl = document.querySelector('#TagifyCustomInlineSuggestion');
 const TagifyCustomListSuggestionEl = document.querySelector('#TagifyCustomListSuggestion');

  fetch('/admin/api/skills')
    .then(res => res.json())
    .then(data => {
      // Map skills to the format Tagify expects: value + custom properties (like id)
      const skillOptions = data.map(skill => ({
        value: skill.name,
        id: skill.id
      }));

      new Tagify(TagifyCustomListSuggestionEl, {
        whitelist: skillOptions,
        enforceWhitelist: true,
        dropdown: {
          maxItems: 500,
          enabled: 0,
          closeOnSelect: false
        }
      });

      // OPTIONAL: Listen for tag selection and see the ID
      TagifyCustomListSuggestionEl.addEventListener('change', (e) => {
        const selected = e.detail.tagify.value; // array of selected tags
        console.log('Selected:', selected); // each item has .value and .id
      });
    });

  // Users List suggestion
  //------------------------------------------------------
  const TagifyUserListEl = document.querySelector('#TagifyUserList');

  const usersList = [
    {
      value: 1,
      name: 'Justinian Hattersley',
      avatar: 'https://i.pravatar.cc/80?img=1',
      email: 'jhattersley0@ucsd.edu'
    },
    {
      value: 2,
      name: 'Antons Esson',
      avatar: 'https://i.pravatar.cc/80?img=2',
      email: 'aesson1@ning.com'
    },
    {
      value: 3,
      name: 'Ardeen Batisse',
      avatar: 'https://i.pravatar.cc/80?img=3',
      email: 'abatisse2@nih.gov'
    },
    {
      value: 4,
      name: 'Graeme Yellowley',
      avatar: 'https://i.pravatar.cc/80?img=4',
      email: 'gyellowley3@behance.net'
    },
    {
      value: 5,
      name: 'Dido Wilford',
      avatar: 'https://i.pravatar.cc/80?img=5',
      email: 'dwilford4@jugem.jp'
    },
    {
      value: 6,
      name: 'Celesta Orwin',
      avatar: 'https://i.pravatar.cc/80?img=6',
      email: 'corwin5@meetup.com'
    },
    {
      value: 7,
      name: 'Sally Main',
      avatar: 'https://i.pravatar.cc/80?img=7',
      email: 'smain6@techcrunch.com'
    },
    {
      value: 8,
      name: 'Grethel Haysman',
      avatar: 'https://i.pravatar.cc/80?img=8',
      email: 'ghaysman7@mashable.com'
    },
    {
      value: 9,
      name: 'Marvin Mandrake',
      avatar: 'https://i.pravatar.cc/80?img=9',
      email: 'mmandrake8@sourceforge.net'
    },
    {
      value: 10,
      name: 'Corrie Tidey',
      avatar: 'https://i.pravatar.cc/80?img=10',
      email: 'ctidey9@youtube.com'
    }
  ];

  function tagTemplate(tagData) {
    return `
    <tag title="${tagData.title || tagData.email}"
      contenteditable='false'
      spellcheck='false'
      tabIndex="-1"
      class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ''}"
      ${this.getAttributes(tagData)}
    >
      <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
      <div>
        <div class='tagify__tag__avatar-wrap'>
          <img onerror="this.style.visibility='hidden'" src="${tagData.avatar}">
        </div>
        <span class='tagify__tag-text'>${tagData.name}</span>
      </div>
    </tag>
  `;
  }

  function suggestionItemTemplate(tagData) {
    return `
    <div ${this.getAttributes(tagData)}
      class='tagify__dropdown__item align-items-center ${tagData.class ? tagData.class : ''}'
      tabindex="0"
      role="option"
    >
      ${
        tagData.avatar
          ? `<div class='tagify__dropdown__item__avatar-wrap'>
          <img onerror="this.style.visibility='hidden'" src="${tagData.avatar}">
        </div>`
          : ''
      }
      <div class="fw-medium">${tagData.name}</div>
      <span>${tagData.email}</span>
    </div>
  `;
  }
  function dropdownHeaderTemplate(suggestions) {
    return `
        <div class="${this.settings.classNames.dropdownItem} ${this.settings.classNames.dropdownItem}__addAll">
            <strong>${this.value.length ? `Add remaning` : 'Add All'}</strong>
            <span>${suggestions.length} members</span>
        </div>
    `;
  }

  // initialize Tagify on the above input node reference
  let TagifyUserList = new Tagify(TagifyUserListEl, {
    tagTextProp: 'name', // very important since a custom template is used with this property as text. allows typing a "value" or a "name" to match input with whitelist
    enforceWhitelist: true,
    skipInvalid: true, // do not remporarily add invalid tags
    dropdown: {
      closeOnSelect: false,
      enabled: 0,
      classname: 'users-list',
      searchKeys: ['name', 'email'] // very important to set by which keys to search for suggesttions when typing
    },
    templates: {
      tag: tagTemplate,
      dropdownItem: suggestionItemTemplate,
      dropdownHeader: dropdownHeaderTemplate
    },
    whitelist: usersList
  });

  // attach events listeners
  TagifyUserList.on('dropdown:select', onSelectSuggestion) // allows selecting all the suggested (whitelist) items
    .on('edit:start', onEditStart); // show custom text in the tag while in edit-mode

  function onSelectSuggestion(e) {
    // custom class from "dropdownHeaderTemplate"
    if (e.detail.elm.classList.contains(`${TagifyUserList.settings.classNames.dropdownItem}__addAll`))
      TagifyUserList.dropdown.selectAll();
  }

  function onEditStart({ detail: { tag, data } }) {
    TagifyUserList.setTagTextNode(tag, `${data.name} <${data.email}>`);
  }

  // Email List suggestion
  //------------------------------------------------------
  // generate random whitelist items (for the demo)
  let randomStringsArr = Array.apply(null, Array(100)).map(function () {
    return (
      Array.apply(null, Array(~~(Math.random() * 10 + 3)))
        .map(function () {
          return String.fromCharCode(Math.random() * (123 - 97) + 97);
        })
        .join('') + '@gmail.com'
    );
  });

  const TagifyEmailListEl = document.querySelector('#TagifyEmailList'),
    TagifyEmailList = new Tagify(TagifyEmailListEl, {
      // email address validation (https://stackoverflow.com/a/46181/104380)
      pattern:
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
      whitelist: randomStringsArr,
      callbacks: {
        invalid: onInvalidTag
      },
      dropdown: {
        position: 'text',
        enabled: 1 // show suggestions dropdown after 1 typed character
      }
    }),
    button = TagifyEmailListEl.nextElementSibling; // "add new tag" action-button

  button.addEventListener('click', onAddButtonClick);

  function onAddButtonClick() {
    TagifyEmailList.addEmptyTag();
  }

  function onInvalidTag(e) {
    console.log('invalid', e.detail);
  }
})();
