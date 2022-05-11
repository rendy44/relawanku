import {ExportToCsv} from 'export-to-csv';

(function ($) {

    class Admin {
        constructor() {
            this.downloadCsv();
        }

        downloadCsv() {
            $('#exp-volunteer').click(
                (e) => {
                    const targetButton = $(e.target),
                        originalText = targetButton.text();
                    targetButton.prop('disabled', true).text('Loading...');
                    e.preventDefault();
                    wp.ajax.send(rlw.prefix + 'volunteers', {})
                        .done((result) => {
                            targetButton.text(originalText);

                            const options = {
                                fieldSeparator: ',',
                                quoteStrings: '"',
                                decimalSeparator: '.',
                                showLabels: true,
                                showTitle: false,
                                title: 'My Awesome CSV',
                                useTextFile: false,
                                useBom: true,
                                useKeysAsHeaders: true,
                                // headers: ['Column 1', 'Column 2', etc...] <-- Won't work with useKeysAsHeaders present!
                            };

                            const csvExporter = new ExportToCsv(options);

                            csvExporter.generateCsv(result);
                        })
                }
            )
        }
    }

    new Admin();
})(jQuery)
